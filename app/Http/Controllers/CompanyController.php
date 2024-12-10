<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:1024',
            'address' => 'required|string|max:500',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
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
        $company->map_link = $request->map_link;

        // Save the updated company
        $company->save();

        // Redirect with success message
        return redirect()->route('company.edit', $company->id)
            ->with('success', 'Company information updated successfully.');
    }

    public function enquiry()
    {
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
        $query = DB::table('enquiries as a')->where('a.status', 1);
        if (Auth::user()->role_id != 1) {
            $query->whereIn('a.id', $assin_users_id);
        }
        $alllead = $query->orderBy('a.id', 'desc')->get();
        $get_user = User::where('status', 1)
            ->where('role_id', 5)
            ->where('is_user_verified', 1)
            ->get();
        return view('company.enquiry', compact('alllead', 'get_user'));
    }
}
