<?php

namespace App\Http\Controllers;

use App\Exports\LeadsExport;
use App\Helpers\Global_helper;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\ContactEnc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class CompanyController extends Controller
{
    // Show the edit form
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    // Handle the update request
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'booking_tax' => 'required|numeric',
            'linkedin' => 'nullable|url',
            'map_link' => 'nullable|string',
        ]);

        // Find the company
        $company = Company::findOrFail($id);

        // Update the company's details
        $company->name = $request->name;

        if ($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            $company->favicon = $request->file('favicon')->store('favicons', 'public');
        }
        if ($request->hasFile('brochure')) {
            $company->brochure = $request->file('brochure')->store('brochure', 'public');
        }

        $company->address = $request->address;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->facebook = $request->facebook;
        $company->twitter = $request->twitter;
        $company->instagram = $request->instagram;
        $company->linkedin = $request->linkedin;
        $company->map_link = $request->map_link;
        $company->header_script = $request->header_script;
        $company->footer_script = $request->footer_script;
        $company->booking_tax = $request->booking_tax;
        $company->map_link = $request->map_link;
        if ($request->youtube_link) {
            $company->youtube_link = $request->youtube_link;
        }

        // Save the updated company
        $company->save();

        // Redirect with success message
        return redirect()->route('company.edit', $company->id)
            ->with('success', 'Company information updated successfully.');
    }

    public function enquiry(Request $request)
    {
        // dd(Global_helper::FollowupNotification());

        $title = 'Enquiry List';
        $login_user_id = Auth::user()->id;
        $login_role_id = Auth::user()->role_id;
        $get_assign_log = DB::table('assign_lead')->where('assign_user_id', $login_user_id)->get();
        $merged = [];
        foreach ($get_assign_log as $item) {
            if (!isset($merged[$item->lead_id])) {
                $merged[$item->lead_id] = [
                    'lead_id' => $item->lead_id,
                    'assign_user_ids' => [],
                    'created_at' => $item->created_at
                ];
            }
            $merged[$item->lead_id]['assign_user_ids'][] = $item->assign_user_id;
        }
        $assin_users_id = array();
        foreach ($merged as $get_assign_id) {
            $assin_users_id[] = $get_assign_id['lead_id'];
        }
        $query = DB::table('enquiries as a')->leftJoin('users as b', 'a.user_id', '=', 'b.id')->select('a.*', 'b.name as user_name')->where('a.status', 1);

        // Apply location filter if provided

        if ($request->location) {
            $query->where('a.location', 'LIKE', '%' . $request->location . '%');
        }
        if ($request->user_id) {
            $query->where('b.id', $request->user_id);
        }

        // Apply budget filter if provided
        if ($request->budget) {
            $query->where('a.budget', '<=', $request->budget);
        }
        if ($request->status) {
            $query->where('a.loan_status',  $request->status);
        }
        if ($request->followup_date) {
            $query->where('a.followup_date',  date('Y-m-d', strtotime($request->followup_date)));
        }
        if ($request->title) {
            $query->where('a.name', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.email', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.mobile_no', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.location', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.budget', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.plan_date', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('a.message', 'LIKE', '%' . $request->title . '%');
            $query->orWhere('b.name', 'LIKE', '%' . $request->title . '%');
        }
        // Apply date filters
        if ($request->from_date && $request->to_date) {
            // Apply date range filter if both dates are available
            $query->whereBetween('a.created_at', [$request->from_date, $request->to_date]);
        } elseif ($request->from_date) {
            // Apply only from_date filter
            $query->whereDate('a.created_at', '>=', $request->from_date);
        } elseif ($request->to_date) {
            // Apply only to_date filter
            $query->whereDate('a.created_at', '<=', $request->to_date);
        }
        if (Auth::user()->role_id != 1) {
            $query->whereIn('a.id', $assin_users_id);
        }

        if (isset($request->download_file) && $request->download_file == "download_file") {

            $alllead = $query->orderBy('a.id', 'desc')->get();
        } else {
            $alllead = $query->orderBy('a.id', 'desc')->paginate(100);
            // Append existing query parameters
            $alllead->appends($request->query());
        }

        $get_user_query = User::where('users.status', 1)
            ->where('users.is_user_verified', 1)
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.title as role_name');

        if (Auth::user()->role_id != 1) {
            $get_user_query->where('users.role_id', 5);
        }

        $get_user = $get_user_query->get();
        $get_filter_user = User::where('status', 1)
            ->where('role_id', '!=', 1)
            ->where('is_user_verified', 1)
            ->get();
        if (isset($request->download_file) && $request->download_file == "download_file") {
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s'); // Example: 2024-01-29_15-30-45
            $fileName = "leads_export_{$timestamp}.csv";
            return Excel::download(new LeadsExport($alllead), $fileName);
            //  Excel::download(new LeadsExport($alllead), 'leads.csv');
        }
        return view('company.enquiry', compact('alllead', 'get_user', 'get_filter_user'));
    }


    public function contact_enquiry(Request $request)
    {
        $title = 'Contact Enquiry List';

        // Fetch records using query builder with pagination
        $alllead = ContactEnc::orderBy('id', 'desc')->paginate(100);

        // Append existing query parameters to pagination links
        $alllead->appends($request->query());
        return view('company.contact-enquiry', compact('alllead'));
    }


    public function career_enquiry(Request $request)
    {
        $title = 'Career Enquiry List';
        $enquiry_career = DB::table('tbl_career_enquiry as a')
            ->leftJoin('job_title as b', 'a.job_id', '=', 'b.id')
            ->select(
                'a.*',
                'b.id as job_post_id'
            )
            ->where('a.status', 1)
            ->where('b.status', 1)
            ->orderBy('a.id', 'desc')
            ->get();
        return view('company.careerenquiry', compact('enquiry_career'));
    }

    public function destroy($id)
    {
        $lead = DB::table('tbl_career_enquiry')->where('id', $id)->where('status', 1)->first();
        $delete_lead = DB::table('tbl_career_enquiry')->where('id', $id)->update(['status' => 3]);
        return redirect()->route('career.enquiry')->with('success', 'Lead deleted successfully.');
    }

    // public function enquiry_destroy( Request $request)
    // {
    //     dd($request->selected_users);
    //     $lead = DB::table('enquiries')->where('id', $id)->where('status', 1)->first();
    //     // $delete_lead = DB::table('enquiries')->where('id',$id)->update(['status'=>3]);
    //     $delete_lead  = DB::table('enquiries')->where('id', $id)->delete();
    //     return redirect()->route('enquiry')->with('success', 'Lead deleted successfully.');
    // }
    public function enquiry_destroy(Request $request)
    {
        // Check if any IDs are selected
        if ($request->has('selected_users')) {
            // Convert selected_users to an array and delete in bulk
            DB::table('enquiries')->whereIn('id', $request->selected_users)->delete();

            return redirect()->route('enquiry')->with('success', 'Selected leads deleted successfully.');
        }

        return redirect()->route('enquiry')->with('error', 'No leads selected for deletion.');
    }

    public function enquiry_reject(Request $request)
    {


        $user_id = Auth::user()->id;
        $lead_id = $request->lead_id;
        $title = "Lead Rejected";
        $status = 8;
        $insert_note = DB::table('notes')->insert(['user_id' => $user_id, 'loan_request_id' => $lead_id, 'title' => $title, 'loan_status' => $status]);



        DB::table('enquiries')
            ->where('id', $lead_id)
            ->update(['loan_status' => $status]);

        if ($insert_note) {
            return true;
        }
    }
}
