<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facilities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FacilitiesController extends Controller
{
    public function index()
    {
        $title = "Facilities List";
        $allfacilities = Facilities::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('facilities.index', compact('title', 'allfacilities'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'title' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Facilities ";
                }

                if ($message) {
                    return redirect()->route('facilities')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $facilities = new Facilities();
            $facilities->title = $request->title;
            $facilities->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('facilities', 'public');
                $facilities->image = $filePath;
            }
            $facilities->save();
            return redirect()->route('facilities')->with('success', 'Facilities Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Facilities";
        $get_facilities = Facilities::where('status', '!=', 3)->where('id', $id)->first();
        $allfacilities = Facilities::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('facilities.index', compact('title', 'allfacilities','get_facilities'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Facilities ";
            }
            if ($message) {
                return redirect()->route('facilities.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $facilities = Facilities::findOrFail($request->hidden_id);
        $facilities->title = $request->title;
        $facilities->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('facilities', 'public');
            $facilities->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $facilities->updated_at = date('Y-m-d H:i:s');
        $facilities->save();
        return redirect()->route('facilities')->with('success', 'Facilities Updated Successfully');
    }


    public function destroy($id)
    {
        $facilities = Facilities::findOrFail($id);
        $facilities->status = 3;
        $facilities->update();
        return redirect()->route('facilities')->with('success', 'Facilities deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Facilities::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_route = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_route;
    }

    public function addfacilities_package(Request $request) {

        $check_facilities = DB::table('add_package_facilities')
            ->where('facilities_id', $request->facilities_id)
            ->where('package_id', $request->package_id)
            ->first();

        if (!$check_facilities) {
            DB::table('add_package_facilities')->insert([
                'facilities_id' => $request->facilities_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Facilities added to package successfully.']);
        }
        DB::table('add_package_facilities')
            ->where('id', $check_facilities->id)
            ->update(['status' => $request->status]);

        return response()->json(['status' => 'success', 'message' => 'Facilities updated in package successfully.']);
    }

}
