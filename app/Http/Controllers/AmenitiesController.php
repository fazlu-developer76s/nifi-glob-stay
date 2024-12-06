<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AmenitiesController extends Controller
{
    public function index()
    {
        $title = "Amenities List";
        $allamenities = Amenities::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('amenities.index', compact('title', 'allamenities'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'title' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Amenities ";
                }

                if ($message) {
                    return redirect()->route('amenities')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $amenities = new Amenities();
            $amenities->title = $request->title;
            $amenities->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('amenities', 'public');
                $amenities->image = $filePath;
            }
            $amenities->save();
            return redirect()->route('amenities')->with('success', 'Amenities Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Amenities";
        $get_amenities = Amenities::where('status', '!=', 3)->where('id', $id)->first();
        $allamenities = Amenities::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('amenities.index', compact('title', 'allamenities','get_amenities'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Amenities ";
            }
            if ($message) {
                return redirect()->route('amenities.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $amenities = Amenities::findOrFail($request->hidden_id);
        $amenities->title = $request->title;
        $amenities->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('amenities', 'public');
            $amenities->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $amenities->updated_at = date('Y-m-d H:i:s');
        $amenities->save();
        return redirect()->route('amenities')->with('success', 'Amenities Updated Successfully');
    }


    public function destroy($id)
    {
        $amenities = Amenities::findOrFail($id);
        $amenities->status = 3;
        $amenities->update();
        return redirect()->route('amenities')->with('success', 'Amenities deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Amenities::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_route = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_route;
    }

    public function addamenities_package(Request $request) {

        $check_amenities = DB::table('add_package_amenities')
            ->where('amenities_id', $request->amenities_id)
            ->where('package_id', $request->package_id)
            ->first();

        if (!$check_amenities) {
            DB::table('add_package_amenities')->insert([
                'amenities_id' => $request->amenities_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Amenities added to package successfully.']);
        }
        DB::table('add_package_amenities')
            ->where('id', $check_amenities->id)
            ->update(['status' => $request->status]);

        return response()->json(['status' => 'success', 'message' => 'Amenities updated in package successfully.']);
    }

}
