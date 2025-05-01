<?php

namespace App\Http\Controllers;

use App\Mail\CareerEnquirys;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\CategoriesModal;
use App\Models\CmsModal;
use App\Models\Kycprocess;
use App\Models\Package;
use App\Models\PetCategory;
use App\Models\Service;
use App\Models\Testimonal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\Enquirys;
use App\Models\Enquiry;
use App\Models\ContactEnc;
use App\Models\Gallary;
use App\Models\Jobs;
use App\Models\JobsEnq;
use App\Models\Page;
use App\Models\Property;
use App\Models\PropertyReview;
use App\Models\Seo;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\PaymentTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\Global_helper;
class ApiController extends Controller
{
    public function get_aadhar_otp(Request $post)
    {
        $rules = array(
            'register_aadhar' => 'required'
        );
        $validate = \Myhelper::FormValidator($rules, $post);
        if ($validate != "no") {
            return $validate;
        }
        $aes_key = "3c8cdd3e3028795dacf67ef25a89509a989768b067a7b591cc468954ad4e1620";
        $aes_iv = "ec5bad40b2162069";
        $user_data = array(
            'p1' => "Advance",
            "p2" => $post->register_aadhar,
            "p3" => "sdfgs6848"
        );
        $encrypt_data = \Myhelper::newEncrypt(json_encode($user_data), $aes_key, $aes_iv);
        $aadharRecord = \DB::table("kycdatas")->where("type", "aadhar")->where('number', $post->register_aadhar)->first();
        if (!$aadharRecord) {
            $url = "http://192.168.0.181:8000/api/v1/validate/aadhar";
            $header = array(
                'Accept: application/json',
                'Content-Type: application/json',
                'client_id: 98dfe4dbc68bb6948a85137927f857e0',
                'x-api-key: 596e6fc87495e86afb31437b866cce1e00a1248169a90f0fa8eefc230a0b7af4',
            );
            $parameter['body'] = $encrypt_data;
            $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", "report", $post->register_aadhar);
            $dec_res = json_decode($result['response']);
            $decrypt_data = \Myhelper::newDecrypt($dec_res->body, $aes_key, $aes_iv);
            if ($decrypt_data != "") {
                $response = json_decode($decrypt_data);
                if (isset($response->data->data->otp_sent) && $response->data->data->otp_sent === true) {
                    return response()->json(['status' => 'TXNOTP', 'message' => "Aadhar verify successfully", "client_id" => $response->data->transaction_id]);
                } else {
                    return response()->json(['status' => 'ERR', 'message' => isset($response->message) ? $response->message : "Please contact your administrator"]);
                }
            } else {
                return response()->json(['status' => 'ERR', 'message' => "Please contact your administrator"]);
            }
        } else {
            $response = json_decode($aadharRecord->response);
            return response()->json([
                'status'  => 'TXN',
                'message' => "Aadhar re-verified successfully",
                "profile" => "data:image/png;base64, " . $response->profile_image,
                "mobile"  => $aadharRecord->mobile,
                'state'   => $response->address->state,
                'pincode' => $response->zip,
                'city'    => $response->address->po,
                'address' => $response->address->house . " " . $response->address->street . " " . $response->address->loc
            ]);
        }
    }

    public function checkaadharotp(Request $post)
    {
        $rules = array(
            'otp'       => 'required',
            'client_id' => "required",
            'mobile'    => "required"
        );
        $validate = \Myhelper::FormValidator($rules, $post);
        if ($validate != "no") {
            return $validate;
        }
        $aes_key = "3c8cdd3e3028795dacf67ef25a89509a989768b067a7b591cc468954ad4e1620";
        $aes_iv = "ec5bad40b2162069";
        $user_data = array(
            'p1' => "Advance",
            "p2" => $post->otp,
            "p3" => $post->client_id
        );
        $encrypt_data = \Myhelper::newEncrypt(json_encode($user_data), $aes_key, $aes_iv);
        $url = "http://192.168.0.181:8000/api/v1/validate/otp-submit";
        $header = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'client_id: 98dfe4dbc68bb6948a85137927f857e0',
            'x-api-key: 596e6fc87495e86afb31437b866cce1e00a1248169a90f0fa8eefc230a0b7af4',
        );
        $parameter['body'] = $encrypt_data;
        $result = \Myhelper::curl($url, "POST", json_encode($parameter), $header, "yes", "report", $post->mobile);
        $dec_res = json_decode($result['response']);
        $decrypt_data = \Myhelper::newDecrypt($dec_res->body, $aes_key, $aes_iv);
        if ($decrypt_data != "") {
            $response = json_decode($decrypt_data);
            if (isset($response->status) && $response->status === true) {
                \DB::table("kycdatas")->insert([
                    "type"   => "aadhar",
                    "name"   => $response->data->data->full_name,
                    "number" => $response->data->data->aadhaar_number,
                    "mobile" => $post->mobile,
                    "state"  => $post->client_id,
                    "response" => json_encode($response->data),
                    'user_id' => \Auth::id()
                ]);
                return response()->json([
                    'status'  => 'TXN',
                    'message' => "Aadhar verified successfully",
                    "profile" => "data:image/png;base64, " . $response->data->data->profile_image,
                    "mobile"  => $post->mobile,
                    'state'   => $response->data->data->address->state,
                    'pincode' => $response->data->data->zip,
                    'city'    => $response->data->data->address->po,
                    'address' => $response->data->data->address->house . " " . $response->data->data->address->street . " " . $response->data->data->address->landmark . " " . $response->data->data->address->loc
                ]);
            } else {
                return response()->json(['status' => 'ERR', 'message' => isset($response->message) ? $response->message : "Please contact your administrator"]);
            }
        } else {
            return response()->json(['status' => 'ERR', 'message' => "Please contact your administrator"]);
        }
    }

    public function update_kyc(Request $request)
    {
        $user = $request->user;
        $user_id = $user->id;
        $user_update = User::where('id', $user_id)->first();
        if (!$user_update) {
            return response()->json(['status' => 'Error', 'message' => 'User not found']);
        }
        $user_already_exist = User::where(function($query) use ($request) {
            $query->where('email', $request->email)
                  ->orWhere('mobile_no', $request->mobile_no);
        })->where('id', '!=', $user_id)->first();

        if ($user_already_exist) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Email or Mobile No already exists'
            ]);
        }

        if ($request->name) {
            $user_update->name = $request->name;
        }
        if ($request->email) {
            $user_update->email = $request->email;
        }
        if ($request->mobile_no) {
            $user_update->mobile_no = $request->mobile_no;
        }
        if ($request->address) {
            $user_update->address = $request->address;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('profile_pictures', 'public');
            $user_update->image = $filePath;
        }
        $user_update->save();
        return response()->json(['status' => 'OK', 'message' => "Profile updated successfully"]);
    }

    public function get_services()
    {
        $get_service = Service::where('status', 1)->get();
        if ($get_service) {
            return response()->json(['status' => 'Success', 'message' => 'Services fetched successfully', 'data' => $get_service]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'No services found']);
        }
    }

    public function get_packages()
    {
        $get_package = Package::where('status', 1)->orderBy('id', 'desc')->get();
        $add_package_service = array();
        if (!empty($get_package)) {
            foreach ($get_package as $pack) {
                $pack->service = DB::table('add_package_service as a')->leftJoin('services as b', 'b.id', '=', 'a.service_id')->select('a.package_id', 'a.service_id', 'b.*')->where('a.status', 1)->where('b.status', 1)->where('a.package_id', $pack->id)->get();
                $add_package_service[] = $pack;
            }
        }

        if ($add_package_service) {
            return response()->json(['status' => 'Success', 'message' => 'Packages fetched successfully', 'data' => $add_package_service]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'No packages found']);
        }
    }

    public function create_pet(Request $request)
    {
        $rules = array(
            'pet_name'       => 'required',
            'pet_image' => "required",
        );
        $validate = \Myhelper::FormValidator($rules, $request);
        if ($validate != "no") {
            return $validate;
        }
        $check_data = $this->check_exist_data($request, null);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->pet_name) {
                $message .= "Pet Category ";
            }
            if ($message) {
                return response()->json(['status' => 'Error', 'message' => $message . 'already exists.']);
            }
        }
        $pet = new PetCategory();
        if ($request->pet_name) {
            $pet->title = $request->pet_name;
        }
        $pet->user_id = $request->user->id;
        if ($request->hasFile('pet_image')) {
            $file = $request->file('pet_image');
            $filePath = $file->store('pet_category', 'public');
            $pet->image = $filePath;
        }
        if ($request->pet_size) {
            $pet->pet_size = $request->pet_size;
        }
        if ($request->pet_bred) {
            $pet->pet_bred = $request->pet_bred;
        }
        $pet->save();
        return response()->json(['status' => 'OK', 'message' => "Pet Add Successfully"]);
    }

    public function list_pet(Request $request)
    {
        $get_pet = PetCategory::where('user_id', $request->user->id)->where('status', 1)->get();
        if ($get_pet) {
            return response()->json(['status' => 'Success', 'message' => 'Pet List Successfully', 'data' => $get_pet]);
        }
    }

    public function update_pet(Request $request, $id)
    {
        if (!$id) {
            return response()->json(['status' => 'Error', 'message' => 'Pet ID is required']);
        }
        if ($request->method() == "GET") {
            if (!empty($id)) {
                $get_single_pet = PetCategory::where('id', $id)->where('status', 1)->get();
                if ($get_single_pet) {
                    return response()->json(['status' => 'Success', 'message' => 'Single Pet Fetch Successfully', 'data' => $get_single_pet]);
                }
            }
        }

        if ($request->method() == "POST") {
            $rules = array(
                'pet_name'       => 'required',
            );
            $validate = \Myhelper::FormValidator($rules, $request);
            if ($validate != "no") {
                return $validate;
            }
            $check_data = $this->check_exist_data($request, $id);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->pet_name) {
                    $message .= "Pet Category ";
                }
                if ($message) {
                    return response()->json(['status' => 'ERR', 'message' => "Pet Category Already Exists"]);
                }
            }
            $pet = PetCategory::findOrfail($id);

            if ($request->pet_name) {
                $pet->title = $request->pet_name;
            }
            $pet->user_id = $request->user->id;
            if ($request->hasFile('pet_image')) {
                $file = $request->file('pet_image');
                $filePath = $file->store('pet_category', 'public');
                $pet->image = $filePath;
            }
            if ($request->pet_size) {
                $pet->pet_size = $request->pet_size;
            }
            if ($request->pet_bred) {
                $pet->pet_bred = $request->pet_bred;
            }
            $pet->save();
            return response()->json(['status' => 'OK', 'message' => "Pet Update Successfully"]);
        }
    }

    public function create_booking(Request $request)
    {

        $rules = array(
            'property_id'    => 'required',
            // 'room_id'        => 'required',
            // 'room_no'        => 'required',
            'check_in'       => 'required',
            'check_out'      => 'required',
            'guest_num'      => 'required',
            'booking_days'   => 'required',
            'booking_price'  => 'required',
            'payment_id'            => 'required',
            'name'           => 'required',
            'email'          => 'required',
            'mobile'         => 'required',
            'hotel_category_id' => 'required'
        );

        $validate = \Myhelper::FormValidator($rules, $request);
        if ($validate != "no") {
            return $validate;
        }

        // Check if the room is already booked
        $get_room_status = DB::table('add_floor_property')->where('room_no', $request->room_no)->where('property_id', $request->property_id)->first();

        if(isset($get_room_status->room_status)  && $get_room_status->room_status!= 1){
            return response()->json(['status' => 'Error', 'message' => 'Room is already booked']);
        }
        $tax = $this->fetch_company_info()->getData()->data->booking_tax;
        if($tax == null){
            $tax = 0;
        }

        // Calculate tax amount and total
        $booking_price = $request->booking_price * $request->booking_days;
        $tax_percentage = $tax;
        $tax_amount = ($booking_price * $tax_percentage) / 100;
        $total_amount = $booking_price + $tax_amount;
        // check invoice number already exist
        $invoiceNumber = 'INV-' . now()->format('Y-m-d-H:i:s') . '-' . $request->property_id.$request->user->id.$request->room_no;
        $check_invoice = DB::table('tbl_invoices')->where('invoice_number', $invoiceNumber)->first();
        if ($check_invoice) {
            return response()->json(['status' => 'Error', 'message' => 'Invoice number already exists']);
        }

        // Insert booking
        $inserted = DB::table('tbl_bookings')->insertGetId([
            'user_id'        => $request->user->id,
            'property_id'    => $request->property_id,
            'payment_id'    => $request->payment_id,
            // 'room_id'        => $request->room_id,
            // 'room_no'        => $request->room_no,
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'guest_num'      => $request->guest_num,
            'booking_days'   => $request->booking_days,
            'booking_price'  => $booking_price,
            'tax'            => $tax_percentage,
            'final_amount'   => $total_amount,
            'name'           => $request->name,
            'email'          => $request->email,
            'booking_status' => 2,
            'mobile'         => $request->mobile,
            'payment_mode'         => 1,
            'hotel_category_id' => $request->hotel_category_id
        ]);
        // DB::table('add_floor_property')->where('room_no',$request->room_no)->where('property_id',$request->property_id)->update(['room_status' => 2]);
        $this->send_twillo_otp($request->mobile,'booking_register');
        // genrate invoice
        // $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . $request->property_id.$request->user->id.$request->room_no;
        // $taxAmount   = ($request->booking_price * $tax) / 100;
        // $totalAmount = $request->booking_price + $taxAmount;
        // Generate PDF content
        $get_category = DB::table('tbl_floor')->where('id', $request->hotel_category_id)->first();
        $pdf = Pdf::loadView('invoices.booking_invoice', [
            'user_id'        => $request->user->id,
            'invoice_number' => $invoiceNumber,
            'booking_id'     => $request->property_id,
            'customer_name'  => $request->name,
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'total_amount'   => $total_amount,
            'booking_price'  => $request->booking_price,
            'hotel_category'        => $get_category->title,
            'guest_num'      => $request->guest_num,
            'booking_days'   => $request->booking_days,
            'tax'            => $tax,
            'tax_amount'     => $tax_amount,
            'created_at'     => now()
        ]);

        // Save PDF to storage
        $fileName = 'invoice_' . $invoiceNumber . '.pdf';
        $filePath = 'invoices/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        $invoiceUrl = asset('storage/' . $filePath);

        // Save invoice info
        DB::table('tbl_invoices')->insert([
            'user_id'        => $request->user->id,
            'booking_id'      => $inserted,
            'invoice_number'  => $invoiceNumber,
            'amount'          => $total_amount,
            'tax_percent'     => $tax,
            'tax_amount'      => $tax_amount,
            'invoice_url'     => $invoiceUrl,
            'created_at'      => now(),
            'updated_at'      => now()
        ]);
        // genrate inovice code end
        if ($inserted) {
            return response()->json([
                'status'  => 'OK',
                'message' => 'Booking created successfully',
                'data'    => [
                    'booking_price' => $booking_price,
                    'tax'           => $tax_percentage,
                    'tax_amount'    => $tax_amount,
                    'total_amount'  => $total_amount
                ]
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Failed to create booking']);
        }
    }
    public function fetch_my_booking(Request $request)
    {
        $userId = $request->user->id ?? null;

        if (!$userId) {
            return response()->json([
                'status'  => 'Error',
                'message' => 'Unauthorized access'
            ], 401);
        }

        $get_booking = DB::table('tbl_bookings as a')
            ->leftJoin('properties as b', 'a.property_id', '=', 'b.id')
            ->leftJoin('add_floor_property as d', 'a.room_no', '=', 'd.room_no')
            ->leftJoin('tbl_floor as e', 'd.floor_id', '=', 'e.id')
            ->leftJoin('tbl_invoices as f', 'a.id', '=', 'f.booking_id')
            ->select(
                'a.*',
                'b.hotel_name',
                'b.hotel_address',
                'b.hotel_image',
                'e.title as floor',
                'd.room_no as floor_room_no',
                'f.invoice_number',
                'f.invoice_url'
            )
            ->where('a.user_id', $userId)
            ->where('a.status', 1)
            ->orderBy('a.id', 'desc')
            ->get();

        if ($get_booking->isNotEmpty()) {
            return response()->json([
                'status'  => 'OK',
                'message' => 'Booking fetched successfully',
                'data'    => $get_booking
            ]);
        } else {
            return response()->json([
                'status'  => 'Error',
                'message' => 'No booking found'
            ]);
        }
    }


    public function create_booking_user_info(Request $request){
        $rules = array(
            'insert_id'       => 'required',
            'name'       => 'required',
            'email'       => 'required',
            'mobile'       => 'required'
        );
        $validate = \Myhelper::FormValidator($rules, $request);
        if ($validate != "no") {
            return $validate;
        }
        $insert_id = $request->insert_id;
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $update_booking = DB::table('tbl_bookings')->where('id',$insert_id)->update([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile
        ]);
        if ($update_booking) {
            return response()->json(['status' => 'OK', 'message' => 'Booking user info update successfully','data' => $update_booking]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Failed to update booking']);
        }
    }

    public function fetch_booking(Request $request)
    {

        $booking = DB::table('pet_category')->where('user_id', $request->user->id)->where('status', 1)->orderBy('id', 'desc')->get();

        $get_array = array();
        if (!empty($booking)) {

            foreach ($booking as $book) {
                $book->get_booking = DB::table('tbl_pet_bookings as a')->join('users as b', 'a.customer_id', '=', 'b.id')->select('b.name as user_name', 'a.*')->where('a.status', 1)->where('b.status', 1)->orderBy('id', 'desc')->get();
                $get_array[] = $book;
            }

            return response()->json(['status' => 'OK', 'message' => 'Booking fetched successfully', 'data' => $get_array]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'No booking found']);
        }
    }

    public function accept_booking(Request $request)
    {

        $rules = array(
            'id'       => 'required',
            'booking_status'       => 'required'
        );
        $validate = \Myhelper::FormValidator($rules, $request);
        if ($validate != "no") {
            return $validate;
        }
        $booking_status_update = DB::table('tbl_pet_bookings')
            ->where('id', $request->id)
            ->update(['booking_status' => $request->booking_status]);
        return response()->json(['status' => 'OK', 'message' => 'Booking status updated successfully']);
    }

    public function check_exist_data($request, $id)
    {
        $query = PetCategory::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_pet_category = $query->where(function ($q) use ($request) {
            $q->where('title', $request->pet_name);
        })->first();

        return $check_pet_category;
    }

    public function delete_pet(Request $request)
    {
        $update_pet_status = PetCategory::where('id', $request->id)->update(['status' => 3]);
        if ($update_pet_status) {
            return response()->json(['message' => 'Pet deleted successfully.'], 200);
        }
    }

    public function fetch_company_info()
    {
        $company_info = CmsModal::where('status', 1)->first();
        if ($company_info) {
            return response()->json(['status' => 'OK', 'message' => 'Company Info fetched successfully', 'data' => $company_info], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Company Info not found']);
        }
    }

    public function fetch_category()
    {
        $get_category = CategoriesModal::where('status', 1)->get();
        if ($get_category) {
            return response()->json(['status' => 'OK', 'message' => 'Category fetched successfully', 'data' => $get_category], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Company Info not found']);
        }
    }

    public function fetch_property(Request $request)
    {

        if(isset($request->user->id) && $request->user->id){
            $user_id = $request->user->id;
        }else{
           $user_id = "";
        }
        if (!isset($request->type)) {
            return response()->json(['status' => 'Error', 'message' => 'Type is required'], 400);
        }
        $type = $request->type;
        $get_category = CategoriesModal::where('status',1)->where('id',2);
            // ->when($type != "all", function ($query) use ($type) {
            //     // $query->where('id', $type);
            //     $query->where('id', 2);
            // });
        $get_cate = $get_category->orderBy('id','asc')->get();
        $new_property_get = array();
        foreach($get_cate as $row){
                if(!empty($user_id)){
         $query = DB::table('properties as p')
        ->leftJoin('categories as pg', 'p.category_id', '=', 'pg.id')
        ->leftJoin('whislist_property as c', 'p.id', '=', 'c.property_id')
        ->leftJoin('property_categories as d', 'p.property_category_id', '=', 'd.id')
        ->select(
            'p.*',
            'pg.title as category_name',
            'c.status as whislist_status',
            'd.title as property_category_name'
        )
        ->where([
            ['p.status', '=', 1],
            ['pg.status', '=', 1],
            ['p.category_id', '=', $row->id],
            ['p.is_property_verified', '=', 1],
            ['d.status', '=', 1]
        ]);

        // Group OR conditions for filters
        $query->where(function ($query) use ($request) {
            if ($request->area_type) {
                $query->orWhere('p.hotel_name', 'LIKE', '%' . $request->area_type . '%');
            }
            if ($request->area_size) {
                $query->orWhere('p.area_size', 'LIKE', '%' . $request->area_size . '%');
            }
            // if ($request->area_type) {
            //     $query->orWhere('p.area_type', 'LIKE', '%' . $request->area_type . '%');
            // }
            if ($request->location) {
                $query->orWhere('p.location', 'LIKE', '%' . $request->location . '%');
            }
        });

// Execute the query and fetch properties
$get_property = $query->get();

            }else{
$query = DB::table('properties as p')
    ->leftJoin('categories as pg', 'p.category_id', '=', 'pg.id')
    ->leftJoin('property_categories as d', 'p.property_category_id', '=', 'd.id')
    ->select('p.*', 'pg.title as category_name', 'd.title as property_category_name')
    ->where('p.status', 1)
    ->where('pg.status', 1)
    ->where('p.category_id', $row->id)
    ->where('p.is_property_verified', 1)
    ->where('d.status', 1);

// Add a group for the orWhere conditions
        $query->where(function ($query) use ($request) {
            if ($request->area_type) {
                $query->orWhere('p.hotel_name', 'LIKE', '%' . $request->area_type . '%');
            }
            if ($request->area_size) {
                $query->orWhere('p.area_size', 'LIKE', '%' . $request->area_size . '%');
            }
            // if ($request->area_type) {
            //     $query->orWhere('p.area_type', 'LIKE', '%' . $request->area_type . '%');
            // }
            if ($request->location) {
                $query->orWhere('p.location', 'LIKE', '%' . $request->location . '%');
            }
        });

$get_property = $query->get();

            $get_fac = array();
            foreach($get_property as $property){
                $get_faciflties = DB::table('add_facilities_propery as a')->leftJoin('facilities as b','a.facilities_id','=','b.id')->select('a.facilities_id','b.title as facility_name','a.value as facility_value','b.image as facility_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
                $get_amentities = DB::table('add_amenties as a')->leftJoin('amenities as b','a.amenities_id','=','b.id')->select('a.amenities_id','b.title as amenities_name','b.image as amenities_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
                $get_sub_img = DB::table('properties_images')->where('property_id',$property->id)->where('status',1)->get();
                $property->facilities = $get_faciflties;
                $property->amenities = $get_amentities;
                $property->sub_img =  $get_sub_img;
                $get_fac[] = $property;
            }

            $row->property = $get_property;
            $new_property_get[] = $row;
        }
        return response()->json(['status' => 'Success', 'data' => $new_property_get], 200);
    }
}

    public function fetch_testimonial()
    {
        $get_testimonial = Testimonal::where('status', 1)->get();
        if ($get_testimonial) {
            return response()->json(['status' => 'OK', 'message' => 'Testimonial fetched successfully', 'data' => $get_testimonial], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Testimonial not found']);
        }
    }

    public function fetch_blog(Request $request)
    {
        $get_blog = Blog::where('status', 1);
        if ($request->id) {
            $get_blog->where('id', $request->id);
        }
        $get_blog = $get_blog->get();
        if ($get_blog) {
            return response()->json(['status' => 'OK', 'message' => 'Blog fetched successfully', 'data' => $get_blog], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Blog not found']);
        }
    }

    public function fetch_banner(Request $request)
    {

        $get_banner = Banner::where('status', 1)->where('type', $request->type)->get();
        if ($get_banner) {
            return response()->json(['status' => 'OK', 'message' => 'Banner fetched successfully', 'data' => $get_banner], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Banner not found']);
        }
    }

    public function fetch_seo(Request $request){
        $get_seo = Seo::where('status', 1)->where('url', $request->url)->first();
        if ($get_seo) {
            return response()->json(['status' => 'OK', 'message' => 'SEO fetched successfully', 'data' => $get_seo], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'SEO not found']);
        }
    }

    public function fetch_gallary(Request $request){
        $get_gallary = Gallary::where('status', 1)->get();
        if ($get_gallary) {
            return response()->json(['status' => 'OK', 'message' => 'Gallery fetched successfully', 'data' => $get_gallary], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Gallery not found']);
        }
    }

    public function fetch_job_title(Request $request){
        $get_job_title = Jobs::where('status', 1)->get();
        if ($get_job_title) {
            return response()->json(['status' => 'OK', 'message' => 'Job Title fetched successfully', 'data' => $get_job_title], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Job Title not found']);
        }
    }

    public function fetch_pages(Request $request){

        $get_page = Page::get();
        if ($get_page) {
            return response()->json(['status' => 'OK', 'message' => 'Page fetched successfully', 'data' => $get_page], 200);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Page not found']);
        }
    }

    public function send_enquiry(Request $request)
    {
        $company_info = CmsModal::where('status', 1)->first();
        if ($request->name == '') {
            return response()->json(['status' => 'Error', 'message' => 'Name is required'], 400);
        }

        if ($request->email == '' || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'Error', 'message' => 'A valid email is required'], 400);
        }

        if ($request->mobile_no == '' || !preg_match('/^\d{10}$/', $request->mobile_no)) {
            return response()->json(['status' => 'Error', 'message' => 'Mobile number must be a 10-digit integer'], 400);
        }
        Mail::to($company_info->email)->send(new Enquirys($request));
        $enc = new ContactEnc();
        $enc->name = $request->name;
        $enc->email = $request->email;
        $enc->mobile_no = $request->mobile_no;
        $enc->message = $request->message;
        if($request->property_id){
        $enc->property_id = $request->property_id;
        }
        if($request->location){
        $enc->location = $request->location;
        }
        if($request->budget){
        $enc->budget = $request->budget;
        }
        if($request->plan_date){
        $enc->plan_date = $request->plan_date;
        }
        $enc->save();
        // DB::table('notes')->insert(['loan_request_id' => $enc->id, 'user_id' => 1, 'loan_status' => 1, 'title' => "Initial Stage"]);
        return response()->json(['status' => 'OK', 'message' => 'Enquiry sent successfully'], 200);
    }

    public function send_career_enquiry(Request $request){

        $company_info = CmsModal::where('status', 1)->first();
        if ($request->job_id == '') {
            return response()->json(['status' => 'Error', 'message' => 'Job Title is required'], 400);
        }
        if ($request->name == '') {
            return response()->json(['status' => 'Error', 'message' => 'Name is required'], 400);
        }

        if ($request->email == '' || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'Error', 'message' => 'A valid email is required'], 400);
        }

        if ($request->mobile_no == '' || !preg_match('/^\d{10}$/', $request->mobile_no)) {
            return response()->json(['status' => 'Error', 'message' => 'Mobile number must be a 10-digit integer'], 400);
        }
        $job_info = Jobs::find($request->job_id);
        $request['job_info'] = $job_info;

        Mail::to($company_info->email)->send(new CareerEnquirys($request));

        $enc = new JobsEnq();
        $enc->job_id = $request->job_id;
        $enc->name = $request->name;
        $enc->email = $request->email;
        $enc->phone = $request->mobile_no;
        $enc->description = $request->description;
        if ($request->hasFile('resume')) {
            $imagePath = $request->file('resume')->store('resume', 'public');
            $enc->resume = $imagePath;
        }
        $enc->save();
        return response()->json(['status' => 'OK', 'message' => 'Career Enquiry sent successfully'], 200);
    }

    public function post_review(Request $request){
        $user_id = $request->user->id;
        $review = new PropertyReview();
        $review->user_id = $user_id;
        $review->property_id = $request->property_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return response()->json(['status' => 'OK','message' => 'Review posted successfully'], 200);
    }

    public function fetch_review(Request $request , $id){

        $reviews = DB::table('property_reviews as a')->join('users as b','a.user_id','=','b.id')->select('a.*','b.name as user_name','b.image as user_image')->where('a.property_id',$id)->where('a.status',1)->where('b.status',1)->get();
        if($reviews){
            return response()->json(['status' => 'OK', 'data' => $reviews], 200);
        }else{
            return response()->json(['status' => 'Error','message' => 'No reviews found'], 404);
        }
    }

    public function fetch_facilities(Request $request){
        $facilities = DB::table('facilities')->where('status',1)->get();
        if($facilities){
            return response()->json(['status' => 'OK', 'data' => $facilities], 200);
        }else{
            return response()->json(['status' => 'Error','message' => 'No facilities found'], 404);
        }

    }
    public function fetch_amenities(Request $request){
        $facilities = DB::table('amenities')->where('status',1)->get();
        if($facilities){
            return response()->json(['status' => 'OK', 'data' => $facilities], 200);
        }else{
            return response()->json(['status' => 'Error','message' => 'No amenities found'], 404);
        }

    }

    public function fetch_floor(Request $request){
        $facilities = DB::table('tbl_floor')->where('status',1)->get();
        if($facilities){
            return response()->json(['status' => 'OK', 'data' => $facilities], 200);
        }else{
            return response()->json(['status' => 'Error','message' => 'No floor found'], 404);
        }

    }

    public function  fetch_location_suggestion(Request $request , $id){
        $query = DB::table('properties')->select('location')->where('status',1)->where('location','LIKE','%'.$request->location.'%');
        if($id){
            $query->where('category_id',$id);
        }
        $fetch_location = $query->get();
        if($fetch_location){
            return response()->json(['status' => 'OK', 'data' => $fetch_location], 200);
        }else{
            return response()->json(['status' => 'Error','message' => 'No location found'], 404);
        }

    }

    public function post_booking(Request $request){

    }


    public function property_whislist(Request $request){

        $check_whislist = DB::table('whislist_property')->where('user_id', $request->user->id)->where('property_id', $request->property_id)->first();
        $add_whislist = DB::table('whislist_property')->insert(['user_id'=>$request->user->id,'property_id'=> $request->property_id]);
        if($check_whislist){
            if($check_whislist->status == 1){
                $update_whislist_status = DB::table('whislist_property')->where('user_id', $request->user->id)->where('property_id', $request->property_id)->update(['status'=>2]);
            }else{
                $update_whislist_status = DB::table('whislist_property')->where('user_id', $request->user->id)->where('property_id', $request->property_id)->update(['status'=>1]);
            }
        }else{
            if($add_whislist){
                return response()->json(['status' => 'OK','message' => 'Property whitelisted successfully'], 200);
            } else{
                return response()->json(['status' => 'Error','message' => 'Failed to whitelist property'], 500);
            }
        }
    }

    public function fetch_single_property(Request $request , $id){
        if(isset($request->user->id) && $request->user->id){
           $user_id = $request->user->id;
       }else{
          $user_id = "";
       }
       if (!isset($request->cat)) {
           return response()->json(['status' => 'Error', 'message' => 'Type is required'], 400);
       }
       $type = $request->cat;
       $get_category = CategoriesModal::where('status',1)
           ->when($type != "all", function ($query) use ($type) {
               $query->where('id', $type);
           });
       $get_cate = $get_category->orderBy('id','asc')->get();
       $new_property_get = array();
       foreach($get_cate as $row){
           if(!empty($user_id)){
           $get_property = DB::table('properties as p')->leftJoin('categories as pg','p.category_id','=','pg.id')->leftJoin('whislist_property as c','p.id','=','c.property_id')->select('p.*','pg.title as category_name','c.status as whislist_status')->where('p.status',1)->where('pg.status',1)->where('p.category_id',$row->id)->where('p.is_property_verified',1)->where('p.id',$id)->get();
           }else{
           $get_property = DB::table('properties as p')->leftJoin('categories as pg','p.category_id','=','pg.id')->select('p.*','pg.title as category_name')->where('p.status',1)->where('pg.status',1)->where('p.category_id',$row->id)->where('p.is_property_verified',1)->where('p.id',$id)->get();
           }
           $get_fac = array();
           foreach($get_property as $property){
            $get_faciflties = DB::table('add_facilities_propery as a')->leftJoin('facilities as b','a.facilities_id','=','b.id')->select('a.facilities_id','b.title as facility_name','a.value as facility_value','b.image as facility_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
            $get_amentities = DB::table('add_amenties as a')->leftJoin('amenities as b','a.amenities_id','=','b.id')->select('a.amenities_id','b.title as amenities_name','b.image as amenities_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
            $get_sub_img = DB::table('properties_images')->where('property_id',$property->id)->where('status',1)->get();
            $reviews = DB::table('property_reviews as a')
            ->join('users as b', 'a.user_id', '=', 'b.id')
            ->leftJoin('properties as c', 'c.id', '=', 'a.property_id') // Added left join
            ->select(
                'a.*',
                'b.name as user_name',
                'b.image as user_image'
            )
            ->where('a.status', 1)
            ->where('b.status', 1)
            ->where('c.status', 1)
            ->where('a.property_id', $property->id)
            ->get();
            $property->facilities = $get_faciflties;
            $property->amenities = $get_amentities;
            $property->sub_img =  $get_sub_img;
            $property->review =  $reviews;
            $get_fac[] = $property;
           }

           $row->property = $get_property;
           $new_property_get[] = $row;
       }
       return response()->json(['status' => 'Success', 'data' => $new_property_get], 200);
   }

   public function permission(Request $request){
        $role_id = $request->user->role_id;
        $permission_name = $request->title;
         try {
        // Fetch the permission data from the database
        $get_permission = DB::table('role_permission as a')
            ->join('permissions as b', 'a.permission_id', '=', 'b.id')
            ->join('permission_category as c', 'b.per_cate_id', '=', 'c.id')
            ->select('a.*', 'b.title', 'c.category_name')
            ->where('a.status', 1)
            ->where('b.status', 1)
            ->where('c.status', 1)
            ->where('a.role_id', $role_id)
            ->where('b.title', $permission_name)
            ->first();

        // Check if permission data exists and if the permission_status is 1
        if ($get_permission && $get_permission->permission_status == 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Permission granted',
                'permission_status' => 1
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Permission denied',
            'permission_status' => 2
        ], 200);

    } catch (\Exception $e) {
        // Handle errors and return a proper response
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ], 500);
    }
   }


   public function fetch_booking_property(Request $request){

        $query = DB::table('properties as p')
        ->leftJoin('property_categories as d', 'p.property_category_id', '=', 'd.id')
        ->select('p.*', 'd.title as property_category_name')
        ->where('p.status', 1)
        ->where('p.category_id',1)
        ->where('p.is_property_verified', 1)
        ->where('d.status', 1);
        if($request->min_price && $request->max_price){
            $query->whereBetween('p.discount_amount', [$request->min_price, $request->max_price]);
        }
        $get_property = $query->get();
        $get_fac = array();
        foreach($get_property as $property){
            $get_faciflties = DB::table('add_facilities_propery as a')->leftJoin('facilities as b','a.facilities_id','=','b.id')->select('a.facilities_id','b.title as facility_name','a.value as facility_value','b.image as facility_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
            $get_amentities = DB::table('add_amenties as a')->leftJoin('amenities as b','a.amenities_id','=','b.id')->select('a.amenities_id','b.title as amenities_name','b.image as amenities_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
            $get_sub_img = DB::table('properties_images')->where('property_id',$property->id)->where('status',1)->get();
            $property->facilities = $get_faciflties;
            $property->amenities = $get_amentities;
            $property->sub_img =  $get_sub_img;
            $get_fac[] = $property;
        }
        return response()->json(['status' => 'Success', 'data' => $get_fac], 200);
        }

        public function fetch_single_booking_property(Request $request,$id){

            $query = DB::table('properties as p')
            ->leftJoin('property_categories as d', 'p.property_category_id', '=', 'd.id')
            ->select('p.*', 'd.title as property_category_name')
            ->where('p.status', 1)
            ->where('p.category_id',1)
            ->where('p.is_property_verified', 1)
            ->where('p.id',$id)
            ->where('d.status', 1);
            $get_property = $query->get();
            $get_fac = array();
            foreach($get_property as $property){
                $get_faciflties = DB::table('add_facilities_propery as a')->leftJoin('facilities as b','a.facilities_id','=','b.id')->select('a.facilities_id','b.title as facility_name','a.value as facility_value','b.image as facility_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
                $get_amentities = DB::table('add_amenties as a')->leftJoin('amenities as b','a.amenities_id','=','b.id')->select('a.amenities_id','b.title as amenities_name','b.image as amenities_image')->where('a.status',1)->where('b.status',1)->where('a.property_id',$property->id)->get();
                $get_sub_img = DB::table('properties_images')->where('property_id',$property->id)->where('status',1)->get();
                $get_room = DB::table('add_floor_property as a')
                ->leftJoin('properties as b', 'a.property_id', '=', 'b.id')
                ->leftJoin('tbl_floor as c', 'a.floor_id', '=', 'c.id')
                ->select('a.*', 'b.hotel_name as property_name','c.title as floor_name')
                ->where('a.status', 1)
                ->where('b.status', 1)
                ->where('c.status', 1)
                ->where('b.id', $id)
                ->get();
                $property->facilities = $get_faciflties;
                $property->amenities = $get_amentities;
                $property->sub_img =  $get_sub_img;
                $property->flor_rooms =  $get_room;
                $get_fac[] = $property;
            }
            return response()->json(['status' => 'Success', 'data' => $get_fac], 200);
            }

            public function fetch_room(Request $request , $id ){
                // echo $id; die;
                $query = DB::table('add_floor_property as a')
                ->leftJoin('properties as b', 'a.property_id', '=', 'b.id')
                ->leftJoin('tbl_floor as c', 'a.floor_id', '=', 'c.id')
                ->select('a.*', 'b.hotel_name as property_name','c.title as floor_name')
                ->where('a.status', 1)
                ->where('b.status', 1)
                ->where('c.status', 1)
                ->where('b.id', $id)
                ->get();
                if($query){
                    return response()->json(['status' => 'Success', 'data' => $query], 200);
                }else{
                    return response()->json(['status' => 'Error','message' => 'No room found'], 404);
                }
            }

            public function get_hotel_category(Request $request){
                $get_category = DB::table('tbl_floor')->where('status',1)->get();
                if($get_category){
                    return response()->json(['status' => 'Success', 'data' => $get_category], 200);
                }else{
                    return response()->json(['status' => 'Error','message' => 'No category found'], 404);
                }
            }

public function createOrder(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $amount = $request->amount; // Amount in INR
    $receiptId = 'BOOKING_' . Str::random(8); // Custom receipt ID

    try {
        $orderData = [
            'receipt'         => $receiptId,
            'amount'          => $amount * 100, // Amount in paisa
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture after payment
        ];

        $order = $api->order->create($orderData); // Creates Razorpay Order

        return response()->json([
            'success' => true,
            'order_id' => $order['id'],
            'amount' => $order['amount'],
            'currency' => $order['currency'],
            'receipt' => $order['receipt']
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


        public function payment(Request $request)
        {

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            try {
                // Fetch the payment details
                $payment = $api->payment->fetch($request->razorpay_payment_id);

                // Check if the payment is authorized
                if ($payment->status === 'authorized' || $payment->status === 'captured') {
                    // Capture the payment
                      if ($payment->status === 'authorized') {
                    $payment->capture(['amount' => $payment->amount]); // Amount is in paisa
                      }
                    // Store the payment details
                   $insert =  DB::table('payment_transactions')->insertGetId([
                        'user_id'     => $request->user->id,
                        'booking_id'  => $request->booking_id ?? null,
                        'payment_id'  => $payment->id,
                        'order_id'    => $payment->order_id ?? null,
                        'method'      => $payment->method,
                        'amount'      => $payment->amount / 100, // convert from paisa to INR
                        'currency'    => $payment->currency,
                        'status'      => $payment->status,
                        'response'    => json_encode($payment),
                        'created_at'  => now(), // manually add if timestamps aren't auto-handled
                        'updated_at'  => now()
                    ]);

                    return response()->json(['success' => true, 'message' => 'Payment captured and saved.','data'=>$insert]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Payment not authorized.']);
                }
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
    }

    public function get_property(Request $request){
        $property_id = $request->user->id;
        $get_property = DB::table('properties')->where('id',$property_id)->first();
        if ($get_property) {
            return response()->json([
                'status'  => 'OK',
                'message' => 'Property fetched successfully',
                'data'    => $get_property
            ]);
        } else {
            return response()->json([
                'status'  => 'Error',
                'message' => 'No property found'
            ]);
        }
    }

    public function get_hotel_info(Request $request){

        $property_id = $request->user->id;
        $get_property = DB::table('properties')->where('id',$property_id)->first();
        $get_property->get_bookings = DB::table('tbl_bookings as a')->leftJoin('tbl_invoices as b','b.booking_id','=','a.id')->leftJoin('payment_transactions as c','a.payment_id','=','c.id')->select('a.*','b.invoice_number','b.invoice_url','c.payment_id as payment_id_raz','c.order_id as order_id_raz','c.method as method_raz','c.amount as amount_raz','c.currency as currency_raz','c.status as status_raz','c.response as response_raz','c.created_at as created_at_raz')->where('a.property_id',$property_id)->where('a.status',1)->orderBy('a.id','desc')->get();
        $get_property->get_available_room  = DB::table('add_floor_property as a')
        ->leftJoin('properties as b', 'a.property_id', '=', 'b.id')
        ->leftJoin('tbl_floor as c', 'a.floor_id', '=', 'c.id')
        ->select('a.*', 'b.hotel_name as property_name','c.title as floor_name')
        ->where('a.status', 1)
        ->where('b.status', 1)
        ->where('c.status', 1)
        ->where('b.id', $property_id)
        ->get();
        $history = [];
        foreach($get_property->get_available_room as $row){
            $row->get_room_history = DB::table('tbl_bookings as a')->where('room_no',$row->room_no)->orderBy('id','desc')->get();
            $history[] = $row;
        }
        $get_property->room_history = $history;
        if ($get_property) {
            return response()->json([
                'status'  => 'OK',
                'message' => 'Property fetched successfully',
                'data'    => $get_property
            ]);
        } else {
            return response()->json([
                'status'  => 'Error',
                'message' => 'No property found'
            ]);
        }

    }

    public function get_hotel_bookings(Request $request){
        $property_id = $request->user->id;
        $get_property = DB::table('tbl_bookings as a')->leftJoin('properties as b','b.id','=','a.property_id')->select('a.*','b.hotel_name','b.hotel_image','hotel_address')->where('a.property_id',$property_id)->where('a.status',1)->orderBy('a.id','desc')->get();
        if ($get_property) {
            return response()->json([
                'status'  => 'OK',
                'message' => 'Property fetched successfully',
                'data'    => $get_property
            ]);
        } else {
            return response()->json([
                'status'  => 'Error',
                'message' => 'No property found'
            ]);
        }
    }

    public function update_booking_status(Request $request){

        $rules = array(
            'property_id'    => 'required',
            'room_no'        => 'required',
            'room_id'        => 'required',
            'booking_id'       => 'required',
            'booking_status'       => 'required'
        );
        $user_id = $request->user->id;

        $get_bookings = DB::table('tbl_bookings')->where('id',$request->booking_id)->first();
        $get_user = DB::table('users')->where('id',$get_bookings->user_id)->first();

        // if($request->booking_status == 2){
        //     DB::table('tbl_bookings')->where('id',$request->booking_id)->update(['status' => 2]);
        //     DB::table('add_floor_property')->where('room_no',$request->room_no)->where('property_id',$request->property_id)->update(['room_status' => 2]);
        //     $this->send_twillo_otp($get_user->mobile,'booking_register');
        // }
        if($request->booking_status == 3){
            DB::table('tbl_bookings')->where('id',$request->booking_id)->update(['booking_status' => 3 , 'room_id' => $request->room_id ,  'room_no' => $request->room_no]);
            DB::table('add_floor_property')->where('room_no',$request->room_no)->where('property_id',$request->property_id)->update(['room_status' => 3]);
            $this->send_twillo_otp($get_bookings->mobile,'check_in');
        }
        if($request->booking_status == 4){
            DB::table('tbl_bookings')->where('id',$request->booking_id)->update(['booking_status' => 5]);
            DB::table('add_floor_property')->where('room_no',$request->room_no)->where('property_id',$request->property_id)->update(['room_status' => 1]);
            $this->send_twillo_otp($get_bookings->mobile,'check_out');

        }
           return response()->json([
            'status' => "OK",
            'message' => "Booking Status Update Successfully",
        ], 200);

    }

    public function send_twillo_otp($mobile_no , $type){

        $otp = Global_helper::TwilloSendOtp($mobile_no,$type);
        $module_type = 4;
        $otp_type = 1;
        $mobile_no  = $mobile_no;
        if(isset($request->user->id)){
            $user_id = $request->user->id;
        }else{
            $user_id = '';
        }
        if($type == "booking_verify"){
            $this->GenerateOTP($otp, $module_type, $otp_type, $mobile_no ,$user_id);
        }
        return response()->json([
            'status' => "OK",
            'message' => "Twillo Otp Sent Successfully",
        ], 200);

    }

}




