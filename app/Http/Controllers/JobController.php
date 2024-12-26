<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $title = "Job List";
        $allJob = Jobs::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('Job.index', compact('title', 'allJob'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'title' => 'required',
                'exp' => 'required',
                'status' => 'required',
            ]);
            $check_data = $this->check_exist_data($request, null);
            if ($check_data) {
                $message = '';
                if ($check_data->title == $request->title) {
                    $message .= "Job ";
                }
                if ($message) {
                    return redirect()->route('job')
                        ->with('error', trim($message) . ' Already Exists');
                }
            }
            $Job = new Jobs();
            $Job->title = $request->title;
            $Job->exp = $request->exp;
            $Job->description = $request->description;
            $Job->status = $request->status;
            $Job->save();
            return redirect()->route('job')->with('success', 'Job Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Job";
        $get_Job = Jobs::where('status', '!=', 3)->where('id', $id)->first();
        $allJob = Jobs::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('Job.index', compact('title', 'allJob','get_Job'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'exp' => 'required',
            'status' => 'required',
        ]);
        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->title == $request->title) {
                $message .= "Job ";
            }
            if ($message) {
                return redirect()->route('Job.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $Job = Jobs::findOrFail($request->hidden_id);
        $Job->title = $request->title;
        $Job->exp = $request->exp;
        $Job->description = $request->description;
        $Job->status = $request->status;
        $Job->updated_at = date('Y-m-d H:i:s');
        $Job->save();
        return redirect()->route('job')->with('success', 'Job Updated Successfully');
    }


    public function destroy($id)
    {
        $Job = Jobs::findOrFail($id);
        $Job->status = 3;
        $Job->update();
        return redirect()->route('job')->with('success', 'Job deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Jobs::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_Job = $query->where(function ($q) use ($request) {
            $q->where('title', $request->title);
        })->first();

        return $check_Job;
    }
}
