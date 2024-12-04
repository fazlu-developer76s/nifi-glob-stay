<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\PerCategory;
use App\Models\Permission;
use DB;
use App\Models\PersubCategory;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use PDO;

class PermissionsubCategory extends Controller
{

    public function index()
    {
        $title = 'Permission';
        $get_permission_subcategory = DB::table('permissions as a')->join('permission_category as b','a.per_cate_id','=','b.id')->select('a.*','b.category_name as category')->where('b.status',1)->where('a.status','!=',3)->get();
        $get_category = PerCategory::where('status',1)->get();
        return view('permission_category.subcategory', compact('title', 'get_permission_subcategory','get_category'));
    }

    public function store_permission_subcategory(Request $request)
    {

        if ($request->hidden_id) {
            $check_data = $this->check_exist_data($request->title, $request->hidden_id);
            if ($check_data) {
                return redirect()->route('permission.subcategory')->with('error', 'Permission already exists.');
            }
            $permission_subcategory = PersubCategory::findOrFail($request->hidden_id);
            $request->validate([
                'title' => 'required',
                'status' => 'required',
                'per_cate_id' => 'required',
            ]);

            $permission_subcategory->title = $request->title;
            $permission_subcategory->per_cate_id = $request->per_cate_id;
            $permission_subcategory->status = $request->status;
            $permission_subcategory->update();
            return redirect()->route('permission.subcategory')->with('success', 'Permission updated successfully.');
        }
        $check_data =  $this->check_exist_data($request->title, null);
        if ($check_data) {
            return redirect()->route('permission.subcategory')->with('error', 'Permission  already exists.');
        }
        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'per_cate_id' => 'required',
        ]);
        $permission_subcategory = new PersubCategory();
        $permission_subcategory->title = $request->title;
        $permission_subcategory->per_cate_id = $request->per_cate_id;
        $permission_subcategory->status = $request->status;
        $permission_subcategory->save();
        return redirect()->route('permission.subcategory')->with('success', 'Permission created successfully.');
    }

    public function edit_permission_subcategory($id)
    {
        $title = 'Edit Permission Category';
        $find_permission_subcategory = PersubCategory::find($id);
        $get_permission_subcategory = DB::table('permissions as a')->join('permission_category as b','a.per_cate_id','=','b.id')->select('a.*','b.category_name as category')->where('b.status',1)->where('a.status','!=',3)->get();
        $get_category = PerCategory::where('status',1)->get();
        return view('permission_category.subcategory', compact('title', 'get_permission_subcategory', 'find_permission_subcategory','get_category'));
    }

    public function destroy_permission_subcategory($id)
    {

        $permission_subcategory = PersubCategory::findOrFail($id);
        $permission_subcategory->status = 3;
        $permission_subcategory->update();
        return redirect()->route('permission.subcategory')->with('success', 'Permission deleted successfully.');
    }

    public function check_exist_data($title, $id)
    {
        if ($id != null && $title != null) {
            $check_permission_subcategory = PersubCategory::where('title', $title)->where('status', '!=', 3)->first();
            if ($check_permission_subcategory) {
                return true;
            }
        } else {
            $check_permission_subcategory = PersubCategory::where('title', $title)->where('status', '!=', 3)->first();
            if ($check_permission_subcategory) {
                return true;
            }
        }
    }





}
