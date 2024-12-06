<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Permission;
use DB;
use App\Models\Bedtype;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use PDO;

class BedController extends Controller
{

    public function index()
    {
        $title = 'Bad Type';
        $get_bedtype = Bedtype::where('status', '!=', 3)->orderBy('id', 'desc')->get();
        return view('bedtype.index', compact('title', 'get_bedtype'));
    }

    public function store_bedtype(Request $request)
    {

        if ($request->hidden_id) {
            $check_data = $this->check_exist_data($request->title, $request->hidden_id);
            if ($check_data) {
                return redirect()->route('bedtype')->with('error', 'Bed Type already exists.');
            }
            $bedtype = Bedtype::findOrFail($request->hidden_id);
            $request->validate([
                'title' => 'required',
                'status' => 'required'
            ]);

            $bedtype->title = $request->title;
            $bedtype->status = $request->status;
            $bedtype->update();
            return redirect()->route('bedtype')->with('success', 'Bed Type updated successfully.');
        }
        $check_data =  $this->check_exist_data($request->title, null);
        if ($check_data) {
            return redirect()->route('bedtype')->with('error', 'Bed Type already exists.');
        }
        $request->validate([
            'status' => 'required',
            'title' => 'required',
        ]);
        $bedtype = new Bedtype();
        $bedtype->title = $request->title;
        $bedtype->status = $request->status;
        $bedtype->save();
        return redirect()->route('bedtype')->with('success', 'Bed Type created successfully.');
    }

    public function edit_bedtype($id)
    {
        $title = 'Edit Bed Type';
        $find_bedtype = Bedtype::find($id);
        $get_bedtype = Bedtype::where('status', '!=', 3)->orderBy('id', 'desc')->get();
        return view('bedtype.index', compact('title', 'get_bedtype', 'find_bedtype'));
    }

    public function destroy_bedtype($id)
    {

        $bedtype = Bedtype::findOrFail($id);
        $bedtype->status = 3;
        $bedtype->update();
        return redirect()->route('bedtype')->with('success', 'Bed Type deleted successfully.');
    }

    public function check_exist_data($title, $id)
    {
        if ($id != null && $title != null) {
            $check_bedtype = Bedtype::where('title', $title)->where('status', '!=', 3)->first();
            if ($check_bedtype) {
                return true;
            }
        } else {
            $check_bedtype = Bedtype::where('title', $title)->where('status', '!=', 3)->first();
            if ($check_bedtype) {
                return true;
            }
        }
    }





}
