<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonal;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $title = "Testimonial List";
        $alltestimonial = Testimonal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('testimonial.index', compact('title', 'alltestimonial'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'name' => 'required',
                'rate_count' => 'required|integer',
                'designation' => 'required',
                'description' => 'required',
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Testimonial ";
                }
                if ($message) {
                    return redirect()->route('testimonial')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $testimonial = new Testimonal();
            $testimonial->name = $request->name;
            $testimonial->rate_count = $request->rate_count;
            $testimonial->designation = $request->designation;
            $testimonial->title = $request->title;
            $testimonial->status = $request->status;
            $testimonial->description = $request->description;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('testimonial', 'public');
                $testimonial->image = $filePath;
            }
            $testimonial->save();
            return redirect()->route('testimonial')->with('success', 'Testimonial Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Testimonial";
        $get_testimonial = Testimonal::where('status', '!=', 3)->where('id', $id)->first();
        $alltestimonial = Testimonal::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('testimonial.index', compact('title', 'alltestimonial','get_testimonial'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rate_count' => 'required|integer',
            'designation' => 'required',
            'description' => 'required',
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Testimonial ";
            }
            if ($message) {
                return redirect()->route('testimonial.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $testimonial = Testimonal::findOrFail($request->hidden_id);
        $testimonial->name = $request->name;
        $testimonial->rate_count = $request->rate_count;
        $testimonial->designation = $request->designation;
        $testimonial->title = $request->title;
        $testimonial->status = $request->status;
        $testimonial->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('testimonial', 'public');
            $testimonial->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $testimonial->updated_at = date('Y-m-d H:i:s');
        $testimonial->save();
        return redirect()->route('testimonial')->with('success', 'Testimonial Updated Successfully');
    }


    public function destroy($id)
    {
        $testimonial = Testimonal::findOrFail($id);
        $testimonial->status = 3;
        $testimonial->update();
        return redirect()->route('testimonial')->with('success', 'Testimonial deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Testimonal::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_testimonial = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_testimonial;
    }
}
