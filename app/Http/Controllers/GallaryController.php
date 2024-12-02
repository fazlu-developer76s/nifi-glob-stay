<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallary;
use Illuminate\Support\Facades\Storage;

class GallaryController extends Controller
{
    public function index()
    {
        $title = "Gallary List";
        $allgallary = Gallary::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('gallary.index', compact('title', 'allgallary'));
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required',
            ]);
            $gallary = new Gallary();
            $gallary->status = $request->status;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('gallary', 'public');
                $gallary->image = $filePath;
            }
            $gallary->save();
            return redirect()->route('gallary')->with('success', 'Gallary Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Gallary";
        $get_gallary = Gallary::where('status', '!=', 3)->where('id', $id)->first();
        $allgallary = Gallary::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('gallary.index', compact('title', 'allgallary','get_gallary'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);
        $gallary = Gallary::findOrFail($request->hidden_id);
        $gallary->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('gallary', 'public');
            $gallary->image = $filePath;
            if ($request->filled('hidden_image') && Storage::disk('public')->exists($request->hidden_image)) {
                Storage::disk('public')->delete($request->hidden_image);
            }
        }
        $gallary->updated_at = date('Y-m-d H:i:s');
        $gallary->save();
        return redirect()->route('gallary')->with('success', 'Gallary Updated Successfully');
    }


    public function destroy($id)
    {
        $gallary = Gallary::findOrFail($id);
        $gallary->status = 3;
        $gallary->update();
        return redirect()->route('gallary')->with('success', 'Gallary deleted successfully.');
    }

}
