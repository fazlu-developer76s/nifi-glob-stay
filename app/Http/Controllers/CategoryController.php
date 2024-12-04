<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriesModal;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "Category List";
        $allcategory = CategoriesModal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('categories.index', compact('title', 'allcategory'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'title' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Category ";
                }
                if ($message) {
                    return redirect()->route('category')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $categories = new CategoriesModal();
            $categories->title = $request->title;
            $categories->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('categories', 'public');
                $categories->image = $filePath;
            }
            $categories->save();
            return redirect()->route('category')->with('success', 'Category Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Category";
        $get_category = CategoriesModal::where('status', '!=', 3)->where('id', $id)->first();
        $allcategory = CategoriesModal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('categories.index', compact('title', 'allcategory','get_category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Category ";
            }
            if ($message) {
                return redirect()->route('category.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $categories = CategoriesModal::findOrFail($request->hidden_id);
        $categories->title = $request->title;
        $categories->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('categories', 'public');
            $categories->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $categories->updated_at = date('Y-m-d H:i:s');
        $categories->save();
        return redirect()->route('category')->with('success', 'Category Updated Successfully');
    }


    public function destroy($id)
    {
        $categories = CategoriesModal::findOrFail($id);
        $categories->status = 3;
        $categories->update();
        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = CategoriesModal::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_categories = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_categories;
    }
}
