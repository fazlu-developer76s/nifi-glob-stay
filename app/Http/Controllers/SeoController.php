<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function index()
    {
        $title = "Seo List";
        $allseo = Seo::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('seo.index', compact('title', 'allseo'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'url' => 'required',
                'meta_title' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Seo ";
                }
                if ($message) {
                    return redirect()->route('seo')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $seo = new Seo();
            $seo->url = $request->url;
            $seo->meta_title = $request->meta_title;
            $seo->meta_keyword = $request->meta_keyword;
            $seo->meta_robot = $request->meta_robot;
            $seo->meta_description = $request->meta_description;
            $seo->header_script = $request->header_script;
            $seo->footer_script = $request->footer_script;
            $seo->status = $request->status;
            $seo->save();
            return redirect()->route('seo')->with('success', 'Seo Added Successfully');
        }
        $title = "Create Seo";
        return view('seo.create', compact('title'));

    }

    public function edit($id)
    {
        $title = "Edit Seo";
        $get_seo = Seo::where('status', '!=', 3)->where('id', $id)->first();
        $allseo = Seo::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('seo.create', compact('title', 'allseo','get_seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'url' => 'required',
            'meta_title' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Seo ";
            }
            if ($message) {
                return redirect()->route('seo.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $seo = Seo::findOrFail($request->hidden_id);
        $seo->url = $request->url;
        $seo->meta_title = $request->meta_title;
        $seo->meta_keyword = $request->meta_keyword;
        $seo->meta_robot = $request->meta_robot;
        $seo->meta_description = $request->meta_description;
        $seo->header_script = $request->header_script;
        $seo->footer_script = $request->footer_script;
        $seo->status = $request->status;
        $seo->updated_at = date('Y-m-d H:i:s');
        $seo->save();
        return redirect()->route('seo')->with('success', 'Seo Updated Successfully');
    }


    public function destroy($id)
    {
        $seo = Seo::findOrFail($id);
        $seo->status = 3;
        $seo->update();
        return redirect()->route('seo')->with('success', 'Seo deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Seo::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_seo = $query->where(function ($q) use ($request) {
            $q->where('url', $request->url);
        })->first();

        return $check_seo;
    }
}
