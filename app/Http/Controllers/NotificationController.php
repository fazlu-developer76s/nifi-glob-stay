<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Helpers\Global_helper as GlobalHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function index()
    {
        $title = "Notification List";
        $get_users = DB::table('users')->where('status',1)->where('role_id','!=',1)->get();
        $allnotification1 = Notification::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $allnotification = [];
        foreach($allnotification1 as $note){
            $note->user = DB::table('tbl_notification_user as a')->leftJoin('users as b','a.user_id','=','b.id')->select('a.*','b.name as user_name')->where('notification_id',$note->id)->get();
            $allnotification[] = $note;
        }
        return view('notification.index', compact('title', 'allnotification','get_users'));
    }

    public function create(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'subject' => 'required',
                'message' => 'required',
                // 'date' => 'required|date',
                // 'time' => 'required|date_format:H:i',
                'status' => 'required',
            ]);
            // $check_data = $this->check_exist_data($request, null);
            // if ($check_data) {
            //     $message = '';
            //     if ($check_data->date == $request->date && $check_data->time == $request->time) {
            //         $message .= "Notification with the same date and time ";
            //     }
            //     if ($message) {
            //         return redirect()->route('notification')
            //             ->with('error', trim($message) . 'Already Exists');
            //     }
            // }

            $notification = new Notification();
            $notification->subject = $request->subject;
            $notification->message = $request->message;
            $notification->date = $request->date;
            $notification->time = $request->time;
            $notification->status = $request->status;
            $notification->save();
            if($request->user_ids){

                foreach($request->user_ids as $row){
                    DB::table('tbl_notification_user')->insert(['notification_id'=>$notification->id,'user_id'=>$row]);
                }
            }

            return redirect()->route('notification')->with('success', 'Notification Added Successfully');
        }
    }

    public function edit($id)
    {
        $title = "Edit Notification";
        $get_notification = Notification::where('status', '!=', 3)->where('id', $id)->first();
        $allnotification = Notification::where('status', '!=', '3')->orderBy('id', 'desc')->get();
        $get_users = DB::table('users')->where('status',1)->where('role_id','!=',1)->get();
        return view('notification.index', compact('title', 'allnotification','get_notification','get_users'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            // 'date' => 'required|date',
            // 'time' => 'required|date_format:H:i',
            'status' => 'required',
        ]);

        $check_data = $this->check_exist_data($request, $request->hidden_id);
        if ($check_data) {
            $message = '';
            if ($check_data->date == $request->date && $check_data->time == $request->time) {
                $message .= "Notification with the same date and time ";
            }
            if ($message) {
                return redirect()->route('notification.edit', ['id' => $request->hidden_id])
                    ->with('error', trim($message) . 'Already Exists');
            }
        }

        $notification = Notification::findOrFail($request->hidden_id);
        $notification->subject = $request->subject;
        $notification->message = $request->message;
        $notification->date = $request->date;
        $notification->time = $request->time;
        $notification->status = $request->status;
        $notification->updated_at = now();
        $notification->save();

        return redirect()->route('notification')->with('success', 'Notification Updated Successfully');
    }


    public function check_exist_data($request, $id)
    {
        $query = Notification::where('status', '!=', 3);

        if ($id !== null) {
            $query->where('id', '!=', $id);
        }

        $check_notification = $query->where(function ($q) use ($request) {
            $q->where('date', $request->date)
              ->where('time', $request->time);
        })->first();

        return $check_notification;
    }

    public function destroy($id)
    {
        $testimonial = Notification::findOrFail($id);
        $testimonial->status = 3;
        $testimonial->update();
        return redirect()->route('notification')->with('success', 'Notification deleted successfully.');
    }

}
