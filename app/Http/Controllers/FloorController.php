<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FloorController extends Controller
{
    public function index()
    {
        $title = "Floor List";
        $allfloor = Floor::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('floor.index', compact('title', 'allfloor'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                'title' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Floor ";
                }

                if ($message) {
                    return redirect()->route('floor')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $floor = new Floor();
            $floor->title = $request->title;
            $floor->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('floor', 'public');
                $floor->image = $filePath;
            }
            $floor->save();
            return redirect()->route('floor')->with('success', 'Floor Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Floor";
        $get_floor = Floor::where('status', '!=', 3)->where('id', $id)->first();
        $allfloor = Floor::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('floor.index', compact('title', 'allfloor','get_floor'));

    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'title' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Floor ";
            }
            if ($message) {
                return redirect()->route('floor.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $floor = Floor::findOrFail($request->hidden_id);
        $floor->title = $request->title;
        $floor->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('floor', 'public');
            $floor->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $floor->updated_at = date('Y-m-d H:i:s');
        $floor->save();
        return redirect()->route('floor')->with('success', 'Floor Updated Successfully');
    }


    public function destroy($id)
    {
        $floor = Floor::findOrFail($id);
        $floor->status = 3;
        $floor->update();
        return redirect()->route('floor')->with('success', 'Floor deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Floor::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_route = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_route;
    }

    public function addfloor_package(Request $request) {

        $check_floor = DB::table('add_package_floor')
            ->where('floor_id', $request->floor_id)
            ->where('package_id', $request->package_id)
            ->first();

        if (!$check_floor) {
            DB::table('add_package_floor')->insert([
                'floor_id' => $request->floor_id,
                'package_id' => $request->package_id,
                'status' => $request->status,
            ]);
            return response()->json(['status' => 'success', 'message' => 'Floor added to package successfully.']);
        }
        DB::table('add_package_floor')
            ->where('id', $check_floor->id)
            ->update(['status' => $request->status]);

        return response()->json(['status' => 'success', 'message' => 'Floor updated in package successfully.']);
    }

}
