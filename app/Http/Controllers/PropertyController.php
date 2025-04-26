<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModal;
use App\Models\Facilities;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Global_helper as Helper;
use App\Models\Amenities;
use App\Models\Floor;
use App\Models\Bedtype;
use App\Models\PropertyCategoriesModal;

class PropertyController extends Controller
{
    public function index()
    {
        $title = "Property List";
        $get_property = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.is_property_verified','1')->orderBy('a.id', 'desc')->get();
        $properties = array();
        foreach ($get_property as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $allproperty = $properties;
        return view('property.index', compact('title', 'allproperty'));
    }

    public function pending_index(){

        $title = "Property List";
        $get_property = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.is_property_verified','2')->orderBy('a.id', 'desc')->get();
        $properties = array();
        $is_property = 1;
        foreach ($get_property as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $allproperty = $properties;
        return view('property.index', compact('title', 'allproperty','is_property'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {


            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'youtube_link' => 'nullable|string',
                'rating' => 'nullable|string',
                'price' => 'required|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);

            $checkData = Property::where('login_id', $request->login_id)->first();
            if ($checkData) {
                return redirect()->route('property.create')->with('error', 'This Property Login ID Already Exists .');
            }
            $hotel = new Property();
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->property_category_id = $request->property_category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->youtube_link = $request->youtube_link;
            $hotel->rating = $request->rating;
            $hotel->district_tehsil = $request->district_tehsil;
            $hotel->zipcode = $request->zipcode;
            $hotel->city_village = $request->city_village;
            $hotel->area_size = $request->area_size;
            $hotel->site_specification = $request->site_specification;
            $hotel->price = $request->price;
            $hotel->price_type = $request->price_type;
            $hotel->area_type = $request->area_type;
            $hotel->markup = $request->markup;
            $hotel->markup_value_b2c = $request->markup_value_b2c;
            $hotel->markup_value_b2b = $request->markup_value_b2b;
            $hotel->extra_info_area_size = $request->extra_info_area_size;
            $hotel->extra_info_area_size_type = $request->extra_info_area_size_type;
            $hotel->num_of_open_sides = $request->num_of_open_sides;
            $hotel->location = $request->location;
            $hotel->login_id = $request->login_id;
            $hotel->password = $request->password;
            $get_discount_amount = $request->price * $request->discount / 100;
            $hotel->discount = $request->discount;
            $hotel->discount_amount = $request->price - $get_discount_amount;
            if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('hotel_images', 'public');
            $hotel->hotel_image = $path;
            }
            if ($request->hasFile('brochure')) {
                $brochure_path = $request->file('brochure')->store('brochure', 'public');
                $hotel->brochure = $brochure_path;
            }
            if (Auth::user()->role_id == 1) {
                $hotel->is_property_verified = 1;
            } else {
                $hotel->is_property_verified = 2;
            }
            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            } else {
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();

            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }

            $n = 0;
            if($request->facilities){


            foreach ($request->facilities as $key => $value) {

                if (!empty($value)) {
                    $facilityId = $request->facilities[$n] ?? null;
                    if ($facilityId) {
                        DB::table('add_facilities_propery')->insert([
                            'property_id' => $hotel->id,
                            'facilities_id' => $value,
                            'value' => $request->number[$key],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $n++;
            }
            }

            if ($request->amenities) {
                foreach ($request->amenities as $amenity) {
                    DB::table('add_amenties')->insert(['property_id' => $hotel->id,  'amenities_id' => $amenity]);
                }
            }

            $n1 = 0;

            if ($request->floor) {
                foreach ($request->floor as $key => $floorId) {
                    if (!empty($floorId)) {
                        $floorNumber = $request->floor_number[$key] ?? 0;

                        for ($j = 1; $j <= $floorNumber; $j++) {
                            // Generate room number like 101, 102...201, 202...
                            $roomNumber = ($key + 1) . str_pad($j, 2, '0', STR_PAD_LEFT);

                            DB::table('add_floor_property')->insert([
                                'property_id' => $hotel->id,
                                'floor_id' => $floorId,
                                'value' => $request->floor_number[$key],
                                'room_no' => $roomNumber
                            ]);
                        }

                        $n1++;
                    }
                }
            }





            return redirect()->route('property')->with('success', 'Property Added Successfully');
        }

        $title = "Create Property";
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_propertycategory = PropertyCategoriesModal::where('status', 1)->get();
        $get_facilities = Facilities::where('status', 1)->get();
        $get_floor = Floor::where('status', 1)->get();
        $get_amenities = Amenities::where('status', 1)->get();
        return view('property.create', compact('title', 'get_category', 'get_facilities', 'get_amenities','get_propertycategory','get_floor'));
    }
    public function edit($id)
    {
        if (!$id) {
            return redirect()->route('property');
        }
        $title = "Edit Property";
        $prop = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.id', $id)->get();
        $properties = array();
        foreach ($prop as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $hotel = $properties[0];
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = array();
        $facilitiestable = Facilities::where('status', 1)->get();
        foreach ($facilitiestable as $facility) {
            $get_fac_data = DB::table('add_facilities_propery')->where('property_id', $id)->where('facilities_id', $facility->id)->first();
            if ($get_fac_data) {
                $facility->selected = 1;
                $facility->value = $get_fac_data->value;
            } else {
                $facility->selected = 0;
                $facility->value = 0;
            }
            $get_facilities[] = $facility;
        }
        $get_floor = array();
        $floortable = Floor::where('status', 1)->get();
        foreach ($floortable as $floor) {

            $get_fac_data = DB::table('add_floor_property')->where('property_id', $id)->where('floor_id', $floor->id)->first();
            if ($get_fac_data) {
                $floor->selected = 1;
                $floor->value = $get_fac_data->value;
            } else {
                $floor->selected = 0;
                $floor->value = 0;
            }

            $get_floor[] = $floor;
        }
        $get_amenities = array();
        $amenttable = Amenities::where('status', 1)->get();
        foreach ($amenttable as $ament) {
            $get_fac_data = DB::table('add_amenties')->where('property_id', $id)->where('amenities_id', $ament->id)->first();
            if ($get_fac_data) {
                $ament->selected = 1;
            } else {
                $ament->selected = 0;
            }
            $get_amenities[] = $ament;
        }
        $get_propertycategory = PropertyCategoriesModal::where('status', 1)->get();
        return view('property.create', compact('title', 'hotel', 'get_category', 'get_facilities', 'get_amenities','get_propertycategory','get_floor'));
    }
    public function update(Request $request)
    {
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'youtube_link' => 'nullable|string',
                'rating' => 'nullable|string',
                'price' => 'required|string',
                'login_id' => 'required|string|min:8',
                'password' => 'required|string|min:8',
            ]);
            $checkData = Property::where('login_id', $request->login_id)->where('id','!=',$request->hidden_id)->first();
            if ($checkData) {
                return redirect()->route('property.create')->with('error', 'This Property Login ID Already Exists .');
            }
            $hotel =  Property::findOrFail($request->hidden_id);
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->property_category_id = $request->property_category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->youtube_link = $request->youtube_link;
            $hotel->rating = $request->rating;
            $hotel->district_tehsil = $request->district_tehsil;
            $hotel->zipcode = $request->zipcode;
            $hotel->city_village = $request->city_village;
            $hotel->area_size = $request->area_size;
            $hotel->site_specification = $request->site_specification;
            $hotel->price = $request->price;
            $hotel->price_type = $request->price_type;
            $hotel->area_type = $request->area_type;
            $hotel->markup = $request->markup;
            $hotel->markup_value_b2c = $request->markup_value_b2c;
            $hotel->markup_value_b2b = $request->markup_value_b2b;
            $hotel->extra_info_area_size = $request->extra_info_area_size;
            $hotel->extra_info_area_size_type = $request->extra_info_area_size_type;
            $hotel->num_of_open_sides = $request->num_of_open_sides;
            $hotel->location = $request->location;
            $get_discount_amount = $request->price * $request->discount / 100;
            $hotel->discount = $request->discount;
            $hotel->discount_amount = $request->price - $get_discount_amount;
            $hotel->login_id = $request->login_id;
            $hotel->password = $request->password;
            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('hotel_images', 'public');
                $hotel->hotel_image = $path;
            }
            if ($request->hasFile('brochure')) {
                $brochure_path = $request->file('brochure')->store('brochure', 'public');
                $hotel->brochure = $brochure_path;
            }


            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            } else {
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            $delete_all_facilities = DB::table('add_facilities_propery')->where('property_id', $hotel->id)->delete();
            $n = 0;
            if($request->facilities){
            foreach ($request->facilities as $key => $value) {

                if (!empty($value)) {
                    $facilityId = $request->facilities[$n] ?? null;
                    if ($facilityId) {
                        DB::table('add_facilities_propery')->insert([
                            'property_id' => $hotel->id,
                            'facilities_id' => $value,
                            'value' => $request->number[$key],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $n++;
            }
            }
            $delete_all_amenities = DB::table('add_amenties')->where('property_id', $hotel->id)->delete();
            if ($request->amenities) {
                foreach ($request->amenities as $amenity) {
                    DB::table('add_amenties')->insert(['property_id' => $hotel->id,  'amenities_id' => $amenity]);
                }
            }
            $delete_all_floor = DB::table('add_floor_property')->where('property_id', $hotel->id)->delete();
            $n1 = 0;

            if ($request->floor) {
                foreach ($request->floor as $key => $floorId) {
                    if (!empty($floorId)) {
                        $floorNumber = $request->floor_number[$key] ?? 0;

                        for ($j = 1; $j <= $floorNumber; $j++) {
                            // Generate room number like 101, 102...201, 202...
                            $roomNumber = ($key + 1) . str_pad($j, 2, '0', STR_PAD_LEFT);

                            DB::table('add_floor_property')->insert([
                                'property_id' => $hotel->id,
                                'floor_id' => $floorId,
                                'value' => $request->floor_number[$key],
                                'room_no' => $roomNumber
                            ]);
                        }

                        $n1++;
                    }
                }
            }

            return redirect()->route('property')->with('success', 'Property Update Successfully');
        }
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 3;
        $property->update();
        return redirect()->route('property')->with('success', 'Property deleted successfully.');
    }
    public function check_exist_data($request, $id)
    {
        $query = Property::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_property = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();
        return $check_property;
    }
    public function delete_image(Request $request)
    {
        $image = DB::table('properties_images')->where('id', $request->id)->update(['status' => 3]);
        if ($image) {
            // if ($image->image) {
            //     Storage::disk('public')->delete($image->image);
            // }
            // $image->delete();
            echo 1;
            die;
            return response()->json(['success' => 'Image deleted successfully.']);
        } else {
            return response()->json(['error' => 'Image not found.']);
        }
    }
    public function book_create(Request $request)
    {
        // dd($request);
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'youtube_link' => 'nullable|string',
                'rating' => 'nullable|string',
                'state' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'login_id' => 'required|string|min:8',
                'password' => 'required|string|min:8',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);
            $hotel = new Property();
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->youtube_link = $request->youtube_link;
            $hotel->rating = $request->rating;
            $hotel->state = $request->state;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;

            if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('hotel_images', 'public');
            $hotel->hotel_image = $path;
            }
            if (Auth::user()->role_id == 1) {
                $hotel->is_property_verified = 1;
            } else {
                $hotel->is_property_verified = 2;
            }
            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            } else {
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            return redirect()->route('property')->with('success', 'Property Added Successfully');
        }
        $title = "Create Property";
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = Facilities::where('status', 1)->get();
        return view('property.book_create', compact('title', 'get_category', 'get_facilities'));
    }
    public function book_edit($id)
    {
        if (!$id) {
            return redirect()->route('property');
        }
        $title = "Edit Property";
        $prop = DB::table('properties as a')->join('categories as b', 'a.category_id', '=', 'b.id')->select('a.*', 'b.title as category_name')->where('a.status', '!=', '3')->where('b.status', 1)->where('a.id', $id)->get();
        $properties = array();
        foreach ($prop as $property) {
            $property->images = DB::table('properties_images')->where('property_id', $property->id)->where('status', 1)->get();
            $property->facilities = DB::table('add_facilities_propery as a')->join('facilities as b', 'a.facilities_id', '=', 'b.id')->select('a.*', 'b.title as facility_name')
                ->where('a.status', '1')->where('a.property_id', $property->id)->where('b.status', 1)->get();
            $properties[] = $property;
        }
        $hotel = $properties[0];
        $get_category = CategoriesModal::where('status', 1)->get();
        $get_facilities = array();
        $facilitiestable = Facilities::where('status', 1)->get();
        foreach ($facilitiestable as $facility) {
            $get_fac_data = DB::table('add_facilities_propery')->where('property_id', $id)->where('facilities_id', $facility->id)->first();
            if ($get_fac_data) {
                $facility->selected = 1;
                $facility->value = $get_fac_data->value;
            } else {
                $facility->selected = 0;
                $facility->value = 0;
            }
            $get_facilities[] = $facility;
        }
        return view('property.book_create', compact('title', 'hotel', 'get_category', 'get_facilities'));
    }
    public function book_update(Request $request)
    {
        if ($request->method() == 'POST') {
            $validatedData = $request->validate([
                'category_id' => 'required',
                'hotel_name' => 'required|string|max:255',
                'hotel_address' => 'nullable|string',
                'hotel_description' => 'nullable|string',
                'hotel_map_link' => 'nullable|string',
                'youtube_link' => 'nullable|string',
                'rating' => 'nullable|string',
                'state' => 'required|string',
                'price' => 'required|string',
                'booking_days' => 'nullable|string',
                'distance' => 'nullable|string',
                'location' => 'nullable|string',
                'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            ]);
            // $checkData = Property::where('hotel_name', $request->hotel_name)->first();
            // if ($checkData) {
            //     return redirect()->route('property.create')->with('error', 'Property with this name already exists.');
            // }
            $hotel =  Property::findOrFail($request->hidden_id);
            $hotel->user_id = Auth::user()->id;
            $hotel->category_id = $request->category_id;
            $hotel->hotel_name = $request->hotel_name;
            $hotel->hotel_address = $request->hotel_address;
            $hotel->hotel_description = $request->hotel_description;
            $hotel->hotel_map_link = $request->hotel_map_link;
            $hotel->youtube_link = $request->youtube_link;
            $hotel->rating = $request->rating;
            $hotel->state = $request->state;
            $hotel->price = $request->price;
            $hotel->booking_days = $request->booking_days;
            $hotel->distance = $request->distance;
            $hotel->location = $request->location;
            if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('hotel_images', 'public');
            $hotel->hotel_image = $path;
            }
            if ($request->hasFile('hotel_images')) {
                $images = [];
                foreach ($request->file('hotel_images') as $image) {
                    $filePath = $image->store('hotel_images', 'public');
                    $images[] = $filePath;
                }
                // $hotel->hotel_images = json_encode($images);
            } else {
                $images = array();
            }
            $hotel->save();
            $hotel->hotel_url = str_replace(' ', '-', strtolower($hotel->hotel_name)) . $hotel->id;
            $hotel->save();
            foreach ($images as $image) {
                DB::table('properties_images')->insert(['property_id' => $hotel->id,  'image' => $image]);
            }
            return redirect()->route('property')->with('success', 'Property Update Successfully');
        }
    }

    public function add_room(Request $request, $id)
    {
        if (!$id) {
            return redirect()->route('property');
        }
        if($request->method()=="POST"){
            $validatedData = $request->validate([
                'property_id' => 'required',
                'flor_no' => 'required|string|max:255',
                'room_no' => 'nullable|string',
                'bed_id' => 'nullable|string',
                'status' => 'required'
            ]);
            $insert_book = DB::table('add_book_property')->insertGetId([
                'property_id' => $request->property_id,
                'flor_no' => $request->flor_no,
                'room_no' => $request->room_no,
                'bed_id' => $request->bed_id,
                'status' => $request->status
            ]);
            $n = 0;
            foreach ($request->facilities as $key => $value) {

                if (!empty($value)) {
                    $facilityId = $request->facilities[$n] ?? null;
                    if ($facilityId) {
                        DB::table('add_book_facilities')->insert([
                            'property_id' => $insert_book,
                            'facilities_id' => $value,
                            'value' => $request->number[$key],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
                $n++;
            }

            if ($request->amenities) {
                foreach ($request->amenities as $amenity) {
                    DB::table('add_book_amenties')->insert(['flor_id' => $insert_book,  'amenities_id' => $amenity]);
                }
            }
            return redirect()->route('book.add.room',['id'=>$request->property_id])->with('success', 'Room Added Successfully');
        }

        $allamenities = array();
        $get_facilities = Facilities::where('status', 1)->get();
        $get_amenities = Amenities::where('status', 1)->get();
        $get_bed = Bedtype::where('status', 1)->get();
        $allflor = DB::table('add_book_property as a')
        ->leftJoin('bedtypes as b', 'a.bed_id', '=', 'b.id')
        ->select('a.*', 'b.title as bed_name')
        ->where('a.status', 1)
        ->where('b.status', 1)
        ->get();
        return view('property.add_room', compact('allflor', 'get_facilities', 'get_bed', 'get_amenities', 'id'));
    }
}
