<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyCategoriesModal;
use Illuminate\Support\Facades\Storage;

class PropertyCategoryController extends Controller
{
    public function index()
    {
        $title = "Property Category List";
        $allpropertycategory = PropertyCategoriesModal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('propertycategories.index', compact('title', 'allpropertycategory'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'title' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Property Category ";
                }
                if ($message) {
                    return redirect()->route('propertycategory')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $propertycategories = new PropertyCategoriesModal();
            $propertycategories->title = $request->title;
            $propertycategories->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('propertycategories', 'public');
                $propertycategories->image = $filePath;
            }
            $propertycategories->save();
            return redirect()->route('propertycategory')->with('success', 'Property Category Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Property Category";
        $get_propertycategory = PropertyCategoriesModal::where('status', '!=', 3)->where('id', $id)->first();
        $allpropertycategory = PropertyCategoriesModal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('propertycategories.index', compact('title', 'allpropertycategory','get_propertycategory'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Property Category ";
            }
            if ($message) {
                return redirect()->route('category.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $propertycategories = PropertyCategoriesModal::findOrFail($request->hidden_id);
        $propertycategories->title = $request->title;
        $propertycategories->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('propertycategories', 'public');
            $propertycategories->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $propertycategories->updated_at = date('Y-m-d H:i:s');
        $propertycategories->save();
        return redirect()->route('propertycategory')->with('success', 'Property Category Updated Successfully');
    }


    public function destroy($id)
    {
        $propertycategories = PropertyCategoriesModal::findOrFail($id);
        $propertycategories->status = 3;
        $propertycategories->update();
        return redirect()->route('propertycategory')->with('success', 'Property Category deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = PropertyCategoriesModal::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_propertycategories = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_propertycategories;
    }
}
