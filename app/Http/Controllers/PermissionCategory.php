<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Permission;
use DB;
use App\Models\PerCategory;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use PDO;

class PermissionCategory extends Controller
{

    public function index()
    {
        $title = 'PermissionCategory';
        $get_permission_category = PerCategory::where('status', '!=', 3)->orderBy('id', 'desc')->get();
        return view('permission_category.index', compact('title', 'get_permission_category'));
    }

    public function store_permission_category(Request $request)
    {

        if ($request->hidden_id) {
            $check_data = $this->check_exist_data($request->title, $request->hidden_id);
            if ($check_data) {
                return redirect()->route('permission.category')->with('error', 'Permission Category already exists.');
            }
            $permission_category = PerCategory::findOrFail($request->hidden_id);
            $request->validate([
                'title' => 'required',
                'status' => 'required'
            ]);

            $permission_category->category_name = $request->title;
            $permission_category->status = $request->status;
            $permission_category->update();
            return redirect()->route('permission.category')->with('success', 'Permission Category updated successfully.');
        }
        $check_data =  $this->check_exist_data($request->title, null);
        if ($check_data) {
            return redirect()->route('permission.category')->with('error', 'Permission Category already exists.');
        }
        $request->validate([
            'status' => 'required',
            'title' => 'required',
        ]);
        $permission_category = new PerCategory();
        $permission_category->category_name = $request->title;
        $permission_category->status = $request->status;
        $permission_category->save();
        return redirect()->route('permission.category')->with('success', 'Permission Category created successfully.');
    }

    public function edit_permission_category($id)
    {
        $title = 'Edit Permission Category';
        $find_permission_category = PerCategory::find($id);
        $get_permission_category = PerCategory::where('status', '!=', 3)->orderBy('id', 'desc')->get();
        return view('permission_category.index', compact('title', 'get_permission_category', 'find_permission_category'));
    }

    public function destroy_permission_category($id)
    {

        $permission_category = PerCategory::findOrFail($id);
        $permission_category->status = 3;
        $permission_category->update();
        return redirect()->route('permission.category')->with('success', 'Permission Category deleted successfully.');
    }

    public function check_exist_data($title, $id)
    {
        if ($id != null && $title != null) {
            $check_permission_category = PerCategory::where('category_name', $title)->where('status', '!=', 3)->first();
            if ($check_permission_category) {
                return true;
            }
        } else {
            $check_permission_category = PerCategory::where('category_name', $title)->where('status', '!=', 3)->first();
            if ($check_permission_category) {
                return true;
            }
        }
    }





}
