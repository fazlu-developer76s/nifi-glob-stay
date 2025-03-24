<?php

namespace App\Http\Controllers;

use App\Models\Loan_request;
use Illuminate\Http\Request;
use DB;

class NotesController extends Controller
{

    public function create(Request $request)
    {

        // $get_lead = DB::table('loan_requests')->where('id',$request->lead_id)->first();
        // $get_route_id = DB::table('routezips')->where('status',1)->where('zip_code',$get_lead->zip_code)->first();
        // if(!$get_route_id){
        //     echo 2; die;
        // }
        if ($request->hidden_id) {
            $note_id = $request->hidden_id;
            $update_note = DB::table('notes')->where('id', $note_id)->update(['title' => $request->title]);
            if ($update_note) {
                return response()->json(['message' => 'Note updated successfully.'], 200);
            }
        }
        $user_id = $request->user_id;
        $lead_id = $request->lead_id;
        $status = $request->status;
        $title = $request->title;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $location = $request->location;
        $area_type = $request->area_type;
        $followup_date = $request->followup_date;
        $budget = $request->budget;
        $insert_note = DB::table('notes')->insert(['user_id' => $user_id, 'loan_request_id' => $lead_id, 'title' => $title, 'loan_status' => $status, 'from_date' => $from_date, 'too_date' => $to_date, 'location' => $location, 'area_type' => $area_type, 'followup_date' => $followup_date, 'budget' => $budget]);
        $updateData = [];

    if (!empty($status)) {
        $updateData['loan_status'] = $status;
    }

    if (!empty($from_date)) {
        $updateData['from_date'] = $from_date;
    }

    if (!empty($to_date)) {
        $updateData['too_date'] = $to_date;
    }

    if (!empty($location)) {
        $updateData['location'] = $location;
    }

    if (!empty($area_type)) {
        $updateData['area_type'] = $area_type;
    }

    if (!empty($followup_date)) {
        $updateData['followup_date'] = $followup_date;
    }

    if (!empty($budget)) {
        $updateData['budget'] = $budget;
    }
    $updateData['is_view_followup'] = 2;

    if (!empty($updateData)) {
        DB::table('enquiries')
            ->where('id', $lead_id)
            ->update($updateData);
    }


        if ($request->status == 5) {
            DB::table('kyc_leads')->insert([
                'loan_request_id' => $request->lead_id,
                'user_id' => $request->user_id,
                'route_id' => $request->route_id
            ]);
            echo 1;
            die;
        }
        if ($insert_note) {
            return response()->json(['message' => 'Note added successfully.'], 200);
        }
    }

    public function fetch_notes(Request $request)
    {
        $lead_id = $request->lead_id;

        // Fetching notes with users
        $notes = DB::table('notes')
            ->leftJoin('users', 'notes.user_id', '=', 'users.id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->select(
                'notes.*',
                'users.name as username',
                'roles.title as role_name'
            )
            ->where('notes.loan_request_id', $lead_id)
            ->where('notes.status', 1)
            ->orderBy('notes.id', 'asc')
            ->get();

        $html = ''; // Initialize the HTML variable

        if (!empty($notes)) {
            foreach ($notes as $note) {
                // Switch for loan status
                switch ($note->loan_status) {
                    case 1:
                        $loan_status = "Initial Stage";
                        $class = "warning";
                        $added_by = "Created By";
                        break;
                    case 2:
                        $loan_status = "Follow up / Team Call";
                        $class = "primary";
                        $added_by = "Team Call By";
                        break;
                    case 3:
                        $loan_status = "Follow up / Call Disconnected";
                        $class = "secondary";
                        $added_by = "Call Disconnected By";
                        break;
                    case 4:
                        $loan_status = "Follow up / Ringing ";
                        $class = "warning";
                        $added_by = "Ringing By";
                        break;
                    case 5:
                        $loan_status = "Pipeline ";
                        $class = "success";
                        $added_by = "Pipeline By";
                        break;
                    case 6:
                        $loan_status = "Visit align";
                        $class = "info";
                        $added_by = "Visit align By";
                        break;
                    case 7:
                        $loan_status = "Conversion";
                        $class = "success";
                        $added_by = "Conversion By";
                        break;
                    case 8:
                        $loan_status = "Rejected";
                        $class = "danger";
                        $added_by = "Rejected By";
                        break;
                    case 9:
                        $loan_status = "Lead Assign";
                        $class = "info";
                        $added_by = "Assign By";
                        break;
                    case 10:
                        $loan_status = "Visit Done";
                        $class = "info";
                        $added_by = "Visit Done By";
                        break;
                    case 11:
                        $loan_status = "Breaking Period";
                        $class = "info";
                        $added_by = "Breaking Period By";
                        break;
                    case 12:
                        $loan_status = "Ask To Callback";
                        $class = "info";
                        $added_by = "Ask To Callback By";
                        break;
                    case 13:
                        $loan_status = "Preferred Location";
                        $class = "info";
                        $added_by = "Preferred Location By";
                        break;
                    default:
                        $loan_status = "Unknown";
                        $class = "light";
                        $added_by = " ";
                        break;
                }

                $html .= '
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0">Title: ' . $note->title . '</p>';

                // Display additional fields if available
                // if (!empty($note->from_date) || !empty($note->to_date)) {
                //     $html .= '<p>Date Range: ' . ($note->from_date ?? 'N/A') . ' to ' . ($note->to_date ?? 'N/A') . '</p>';
                // }
                // if (!empty($note->location)) {
                //     $html .= '<p>Location: ' . $note->location . '</p>';
                // }
                // if (!empty($note->area_type)) {
                //     $html .= '<p>Area Type: ' . $note->area_type . '</p>';
                // }
                // if (!empty($note->followup_date)) {
                //     $html .= '<p>Follow-Up Date: ' . date('d F Y', strtotime($note->followup_date)) . '</p>';
                // }
                // if (!empty($note->budget)) {
                //     $html .= '<p>Budget: $' . number_format($note->budget, 2) . '</p>';
                // }

                $html .= '
                        <p>' . str_replace('By', ' ', $added_by) . ' At: ' . date('d F Y h:i A', strtotime($note->created_at)) . '</p>
                        <small>' . $added_by . ': ' . ucwords($note->username) . ' (' . $note->role_name . ')</small>
                    </div>
                    <span class="badge bg-' . $class . ' rounded-pill">' . str_replace('_', ' ', $loan_status) . '</span>
                </div>
            </li>';
            }
        }

        echo $html; // Output the generated HTML
    }





    public function delete_notes(Request $request)
    {
        $note_id = $request->note_id;
        $delete_note = DB::table('notes')->where('id', $note_id)->update(['status' => 3]);
        if ($delete_note) {
            return response()->json(['message' => 'Note deleted successfully.'], 200);
        }
    }

    public function notes_disscuss(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $get_note = DB::table('notes')->where('loan_request_id', $id)->where('title', 'View Lead')->where('user_id', $user_id)->first();
        if ($get_note) {
            DB::table('notes')->insert(['loan_request_id' => $id, 'user_id' => $user_id, 'loan_status' => 3, 'title' => "Under Disscussion"]);
            DB::table('loan_requests')->where('id', $id)->update(['loan_status' => 3]);
        }
    }

    public function update_lead_status(Request $request)
    {
        $lead_id = $request->lead_id;
        DB::table('enquiries')
            ->where('id', $lead_id)
            ->update(['lead_status' => $request->input('lead_status')]);
       return 1;
    }
}
