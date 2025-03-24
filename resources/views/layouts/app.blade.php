
@php
    $company = \App\Helpers\Global_helper::companyDetails();
@endphp
@inject('helper', 'App\Helpers\Global_helper')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ !empty($title) ? $title : 'Globstay' }} </title>
    <style>
        .app-header {
            position: fixed !important;
        }

        .bootstrap-tagsinput {
            margin: 0;
            width: 100%;
            padding: 0.5rem 0.75rem 0;
            font-size: 1rem;
            line-height: 1.25;
            transition: border-color 0.15s ease-in-out;
        }

        .bootstrap-tagsinput.has-focus {
            background-color: #fff;
            border-color: #5cb3fd;
        }

        .label-info {
            display: inline-block;
            background-color: #636c72;
            padding: 0 .4em .15em;
            border-radius: .25rem;
            margin-bottom: 0.4em;
        }

        .bootstrap-tagsinput input {
            margin-bottom: 0.5em;
        }

        div#editor {
            border: 1px solid rgb(0 0 0 / 20%) !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .app-sidebar {
            background: #67722e !important;
            color: black !important;
        }

        .cke_notification_warning {
            display: none !important;
        }

        /* body { */
        /* background-color: #f0f0f0;
        display: flex;
        justify-content: flex-start;
        align-items: flex-end;
        font-family: Arial, sans-serif;
        margin-top: 20px;
        flex-direction: column;
        gap: 10px;
      } */
        .card-note-container {
            margin-top: 60px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 10;
        }

        .card-note {
            background: rgba(255, 255, 255, 0.95);
            width: 280px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            border-radius: 8px;
            border-left: 5px solid #67722e ;
            position: relative;
        }

        .card-note i {
            color: #ff4d4d;
            font-size: 16px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .card-note i:hover {
            color: #e60000;
        }

        .card-note .content-note {
            font-size: 12px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .card-note .content-note p {
            margin: 5px 0;
        }

        .card-note .view-btn-note {
            cursor: pointer;
            padding: 6px 10px;
            background-color: #67722e;
            color: white;
            border-radius: 5px;
            text-align: center;
            border: none;
            font-size: 14px;
            width: 100%;
        }

        .card-note .view-btn-note:hover {
            background-color: #0056b3;
        }
    </style>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $company->favicon) }}">
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <!----Table-- -->
    <link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <!----Table---->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">



</head>
<!----Head----->
@include('layouts.header')

@include('layouts.sidebar')
@yield('content')
<div class="card-note-container">
    <!-- Card-note 1 -->
    @foreach ($helper->FollowupNotification() as $row )
    @switch(@$row->lead_status)
    @case(1)
        @php $lead_status = "Initial Stage"; @endphp
    @break

    @case(2)
        @php $lead_status = "Team Call"; @endphp
    @break

    @case(3)
        @php $lead_status = "Call Disconnected"; @endphp
    @break

    @case(4)
        @php $lead_status = "Ringing"; @endphp
    @break

    @case(5)
        @php $lead_status = "Pipeline"; @endphp
    @break

    @case(6)
        @php $lead_status = "Visit Align"; @endphp
    @break

    @case(7)
        @php $lead_status = "Conversion"; @endphp
    @break

    @case(8)
        @php $lead_status = "Rejected"; @endphp
    @break

    @case(9)
        @php $lead_status = "Assign Lead"; @endphp
    @break
    @case(10)
    @php $lead_status = "Visit Done"; @endphp
        @break
        @case(11)
            @php $lead_status = "Breaking Period"; @endphp
        @break
        @case(12)
            @php $lead_status = "Ask To Callback"; @endphp
        @break
        @case(13)
            @php $lead_status = "Preferred Location"; @endphp
        @break
    @default
        @php $lead_status = "Unknown"; @endphp
@endswitch
    <div class="card-note">
        <i class="fa-solid fa-xmark" onclick="closeCard(this , '{{ $row->id }}')"></i>
        <div class="content-note">
            <h5>Lead {{ $lead_status }}</h5>
            <p><strong>Name:</strong> {{ ucwords($row->name) }}</p>
            <p><strong>Follow-up Date:</strong> {{ date('d-m-Y',strtotime($row->followup_date)) }}</p>
            <p><strong>Lead Created By:</strong> {{ $row->name }} ({{ $row->role_name }})</p>
        </div>
        <a href="{{ route('lead.view',$row->id) }}" target="_blank"><button class="view-btn-note">View Lead Info</button></a>
    </div>
    @endforeach

</div>
<!-- Collect Emi Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form id="modalForm" action="/submit-form" method="POST">
                    <div class="mb-3">
                        <label for="loan_number" class="form-label">Loan Number</label>
                        <input type="text" class="form-control" id="loan_number" name="loan_number" required
                            placeholder="Please Enter Your Loan Number" oninput="FetchLoanDetail();">
                    </div>
                    <div class="mb-3 collect_name d-none">
                        <label for="collect_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="collect_name" name="collect_name" required>
                    </div>
                    <div class="mb-3 collect_amount d-none">
                        <label for="collect_amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="collect_amount" name="collect_amount" required>
                    </div>
                    <div class="mb-3 collect_emi d-none">
                        <label for="collect_emi" class="form-label">Emi</label>
                        <input class="form-control" id="collect_emi" name="collect_emi" rows="3" required>
                    </div>
                    <div class="mb-3 collect_last_emi d-none">
                        <label for="collect_last_emi" class="form-label">Last Emi</label>
                        <input class="form-control" id="collect_last_emi" name="collect_last_emi" rows="3"
                            required>
                    </div>
                    <div class="mb-3 collect_remark d-none">
                        <label for="collect_remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="collect_remark" name="collect_remark" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary submit_button d-none">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
