<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $title = "Banner List";
        $allbanner = Banner::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('banner.index', compact('title', 'allbanner'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'title' => 'required',
                'type' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Banner ";
                }
                if ($message) {
                    return redirect()->route('banner')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->type = $request->type;
            $banner->status = $request->status;
            $banner->description = $request->description;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('banner', 'public');
                $banner->image = $filePath;
            }
            $banner->save();
            return redirect()->route('banner')->with('success', 'Banner Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Banner";
        $get_banner = Banner::where('status', '!=', 3)->where('id', $id)->first();
        $allbanner = Banner::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('banner.index', compact('title', 'allbanner','get_banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Banner ";
            }
            if ($message) {
                return redirect()->route('banner.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $banner = Banner::findOrFail($request->hidden_id);
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->status = $request->status;
        $banner->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('banner', 'public');
            $banner->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->save();
        return redirect()->route('banner')->with('success', 'Banner Updated Successfully');
    }


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = 3;
        $banner->update();
        return redirect()->route('banner')->with('success', 'Banner deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        if($request->type =="home"){
            return false;
        }
        $query = Banner::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_banner = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_banner;
    }
}
