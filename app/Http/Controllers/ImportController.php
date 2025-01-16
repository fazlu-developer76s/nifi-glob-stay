<?php

namespace App\Http\Controllers;

use App\Imports\LeadImport;
use Illuminate\Http\Request;
use App\Models\Import;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ImportController extends Controller
{
    public function index()
    {
        
        $title = "Import List";
        $allimport = DB::table('users as a')->leftJoin('tbl_import as b','b.user_id','=','a.id')->select('a.name as user_name','b.*')->where('b.status',1)->get();
        return view('import.index', compact('title', 'allimport'));
    }

    public function create(Request $request)
    {

          if ($request->method() == 'POST') {
            $request->validate([
                'file' => 'required|mimes:xlsx,csv',
                'title' => 'required'
            ]);
            $import = new LeadImport;
            Excel::import($import, $request->file('file'));
            $insertCount = $import->getInsertCount();
            $duplicateCount = $import->getDuplicateCount();
            $totalCount = $insertCount + $duplicateCount;
            $import = new Import();
            $import->user_id = $request->user_id;
            $import->title = $request->title;
            $import->import_count = $insertCount;
            $import->duplicate_count = $duplicateCount;
            $import->total_count = $totalCount;
            $import->save();

            $message = "Import completed! Total: $totalCount, Inserted: $insertCount, Duplicates: $duplicateCount.";
            return redirect()->route('import')->with('success', $message);
        }
        $title = "Create Import";
        $allmember = DB::table('users')->leftJoin('roles', 'roles.id', '=', 'users.role_id')->where('users.status', '!=', 3)->select('users.*', 'roles.title')->where('roles.status','!=',3)->get();
        return view('import.create', compact('title','allmember'));

    }

    public function edit($id)
    {
        $title = "Edit Import";
        $get_import = Import::where('status', '!=', 3)->where('id', $id)->first();
        $allimport = Import::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        return view('import.create', compact('title', 'allimport','get_import'));
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
                $message .= "Import ";
            }
            if ($message) {
                return redirect()->route('import.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . ' Already Exists');
            }
        }
        $import = Import::findOrFail($request->hidden_id);
        $import->url = $request->url;
        $import->meta_title = $request->meta_title;
        $import->meta_keyword = $request->meta_keyword;
        $import->meta_robot = $request->meta_robot;
        $import->meta_description = $request->meta_description;
        $import->header_script = $request->header_script;
        $import->footer_script = $request->footer_script;
        $import->status = $request->status;
        $import->updated_at = date('Y-m-d H:i:s');
        $import->save();
        return redirect()->route('import')->with('success', 'Import Updated Successfully');
    }


    public function destroy($id)
    {
        $import = Import::findOrFail($id);
        $import->status = 3;
        $import->update();
        return redirect()->route('import')->with('success', 'Import deleted successfully.');
    }

    public function check_exist_data($request, $id)
    {
        $query = Import::where('status', '!=', 3);
        if ($id !== null) {
            $query->where('id', '!=', $id);
        }
        $check_import = $query->where(function ($q) use ($request) {
            $q->where('url', $request->url);
        })->first();

        return $check_import;
    }
}
