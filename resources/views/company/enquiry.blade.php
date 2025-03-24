@extends('layouts/app')
@section('content')
<style>
    .modal {

        /*From Right/Left */
        &.drawer {
            display: flex !important;
            pointer-events: none;

            * {
                pointer-events: none;
            }

            .modal-dialog {
                margin: 0px;
                display: flex;
                flex: auto;
                transform: translate(25%, 0);

                .modal-content {
                    border: none;
                    border-radius: 0px;

                    .modal-body {
                        overflow: auto;
                    }
                }
            }

            &.show {
                pointer-events: auto;

                * {
                    pointer-events: auto;
                }

                .modal-dialog {
                    transform: translate(0, 0);
                }
            }

            &.right-align {
                flex-direction: row-reverse;
            }

            &.left-align {
                &:not(.show) {
                    .modal-dialog {
                        transform: translate(-25%, 0);
                    }
                }
            }
        }
    }
    .job-tracking-vertical {
        display: flex;
        flex-direction: column;
        position: relative;
        padding-left: 31px;
        margin-top: 30px;
    }

    .status {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        position: relative;
    }

    .status-text {
        margin-left: 10px;
    }

    /* All statuses will be green */
    .status-text i { color: green; }

    strong {
        margin-top: 10px !important;
    }

    /* Vertical Line */
    .job-tracking-vertical:before {
        content: '';
        position: absolute;
        left: 17px;
        height: 100%;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #ddd;
    }

    .status:before {
        content: '';
        position: absolute;
        left: -19px;
        top: 50%;
        width: 12px;
        height: 12px;
        background-color: white;
        border: 3px solid #ddd;
        border-radius: 50%;
        z-index: 1;
    }

    .status:before { border-color: green; }

    /* Ensure the vertical line stops at the last item */
    .status:last-child:before { bottom: 0; }

    .status-dot {
        /* width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
        background-color: green;  */
        /* All dots are green */
    }
</style>
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-5">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Enquiry</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Enquiry Lead</li>
                    </ol>
                    <h1 class="page-header mb-0">Enquiry</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <!-- Table Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Enquiry List
                            <!--<a href="{{ route('lead.create') }}" class="ms-auto">-->
                            <!--    <button class="btn btn-primary">Create Lead</button>-->
                            <!--</a>-->
                        </div>


                        <div class="card-body">
                            <form id="filterForm" method="GET" action="{{ route('enquiry') }}" class="mb-4">
                                <div class="row d-flex align-items-center">
                                    @if(Auth::user()->role_id == 1)
                                    <div class="col-md-2">
                                        <select name="user_id" class="form-control" aria-label="Default select example">
                                            <option value="">Select User</option>
                                            @foreach ($get_filter_user as $user)
                                                <option value="{{ $user->id }}" {{ (isset($_GET['user_id']) && $_GET['user_id'] == $user->id) ? 'selected' : '' ; }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                    <div class="col-md-2">
                                        <label for="budget" class="form-label">Budget</label>
                                        <input type="number" id="budget" name="budget" class="form-control" placeholder="Enter budget" value="{{ (isset($_GET['budget']) && $_GET['budget']) ? $_GET['budget'] : '' ; }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" id="location" name="location" class="form-control" placeholder="Enter location" value="{{ (isset($_GET['location']) && $_GET['location']) ? $_GET['location'] : '' ; }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="from_date" class="form-label">From Date</label>
                                        <input type="date" id="from_date" name="from_date" class="form-control" value="{{ (isset($_GET['from_date']) && $_GET['from_date']) ? $_GET['from_date'] : '' ; }}">
                                    </div>

                                    <div class="col-md-2">
                                        <label for="to_date" class="form-label">To Date</label>
                                        <input type="date" id="to_date" name="to_date" class="form-control" value="{{ (isset($_GET['to_date']) && $_GET['to_date']) ? $_GET['to_date'] : '' ; }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="followup_date" class="form-label">FollowUp Date</label>
                                        <input type="date" id="followup_date" name="followup_date" class="form-control" value="{{ (isset($_GET['followup_date']) && $_GET['followup_date']) ? $_GET['followup_date'] : '' ; }}">
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                    <label for="option" class="form-label">Select Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Select an option</option>
                                        <option value="1" {{ (isset($_GET['status'])  &&  $_GET['status']== '1') ? 'selected' : '' }}>Initial Stage </option>
                                        <option value="2" {{ (isset($_GET['status'])  &&  $_GET['status']== '2') ? 'selected' : '' }}>Team Call</option>
                                        <option value="3" {{ (isset($_GET['status'])  &&  $_GET['status']== '3') ? 'selected' : '' }}>Call Disconnected</option>
                                        <option value="4" {{ (isset($_GET['status'])  &&  $_GET['status']== '4') ? 'selected' : '' }}>Ringing</option>
                                        <option value="5" {{ (isset($_GET['status'])  &&  $_GET['status']== '5') ? 'selected' : '' }}>Pipeline</option>
                                        <option value="6" {{ (isset($_GET['status'])  &&  $_GET['status']== '6') ? 'selected' : '' }}>Visit Align</option>
                                        <option value="7" {{ (isset($_GET['status'])  &&  $_GET['status']== '7') ? 'selected' : '' }}>Conversion</option>
                                        <option value="8" {{ (isset($_GET['status'])  &&  $_GET['status']== '8') ? 'selected' : '' }}>Rejected</option>
                                        <option value="10" {{ (isset($_GET['status'])  &&  $_GET['status']== '10') ? 'selected' : '' }}>Visit Done</option>
                                        <option value="11" {{ (isset($_GET['status'])  &&  $_GET['status']== '11') ? 'selected' : '' }}>Breaking Period</option>
                                        <option value="12" {{ (isset($_GET['status'])  &&  $_GET['status']== '12') ? 'selected' : '' }}>Ask To Callback</option>
                                        <option value="13" {{ (isset($_GET['status'])  &&  $_GET['status']== '13') ? 'selected' : '' }}>Preferred Location</option>
                                    </select>

                                </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        @if(Auth::user()->role_id == 1)
                                        <button type="submit" name="download_file" value="download_file" class="btn btn-primary">Export</button>
                                        @endif
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('enquiry') }}">
                                            <button type="button" class="btn btn-secondary">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>

                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <!--<div class="row">-->
                                <!--    <div class="col-md-7">-->

                                <!--    </div>-->

                                <!--    <div class="col-md-3">-->
                                <!--        <form action="{{ route('enquiry') }}" method="POST" enctype="multipart/form-data">-->
                                <!--         @csrf-->
                                <!--        <select name="type" class="form-control">-->
                                <!--            <option value="contact_us">Contact Us</option>-->
                                <!--            <option value="contact_us">Property</option>-->
                                <!--        </select> -->
                                <!--    <input type="submit">-->
                                <!--    </form>-->
                                <!--    </div>-->
                                <!--     <div class="col-md-1">-->

                                <!--    </div>-->
                                <!--</div>-->

                                <thead>

                                    <tr>
                                        <th width="1%"></th>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">User Name</th>
                                        <th class="text-nowrap">Full Name</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">Phone</th>
                                        <th class="text-nowrap">Location</th>
                                        <th class="text-nowrap">Budget</th>
                                        <th class="text-nowrap">Plan Date</th>
                                        <th class="text-nowrap">Description</th>
                                        <th class="text-nowrap">Created At</th>
                                        <th class="text-nowrap">Type</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Lead Status</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($alllead)
                                    @foreach ($alllead as $lead)
                         @switch(@$lead->loan_status)
                                @case(1)
                                    @php $loan_status = "Initial Stage"; @endphp
                                @break

                                @case(2)
                                    @php $loan_status = "Team Call"; @endphp
                                @break

                                @case(3)
                                    @php $loan_status = "Call Disconnected"; @endphp
                                @break

                                @case(4)
                                    @php $loan_status = "Ringing"; @endphp
                                @break

                                @case(5)
                                    @php $loan_status = "Pipeline"; @endphp
                                @break

                                @case(6)
                                    @php $loan_status = "Visit Align"; @endphp
                                @break

                                @case(7)
                                    @php $loan_status = "Conversion"; @endphp
                                @break

                                @case(8)
                                    @php $loan_status = "Rejected"; @endphp
                                @break

                                @case(9)
                                    @php $loan_status = "Assign Lead"; @endphp
                                @break
                                @case(10)
                                @php $loan_status = "Visit Done"; @endphp
                                    @break
                                    @case(11)
                                        @php $loan_status = "Breaking Period"; @endphp
                                    @break
                                    @case(12)
                                        @php $loan_status = "Ask To Callback"; @endphp
                                    @break
                                    @case(13)
                                        @php $loan_status = "Preferred Location"; @endphp
                                    @break
                                @default
                                    @php $loan_status = "Unknown"; @endphp
                            @endswitch

                                    <tr class="odd gradeX">
                                        <td><input type="checkbox" class="checkbox_lead_assign" value="{{ $lead->id }}"></td>
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($lead->user_name) }}</td>
                                        <td>{{ ucwords($lead->name) }}</td>
                                        <td>{{ ucwords($lead->email) }}</td>
                                        <td>{{ $lead->mobile_no }}</td>
                                        <td>{{ $lead->location }}</td>
                                        <td>{{ $lead->budget }}</td>
                                        <td>{{ (!empty($lead->plan_date)) ? date('d-m-Y',strtotime($lead->plan_date)) : '' ; }}</td>

                                        <td>{{ $lead->message }}</td>
                                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d F Y h:i A') }}</td>

                                        <td>
                                            @if(!empty($lead->property_id))
                                            <a href="{{ $lead->property_id ? 'https://globstay.com/details/' . $lead->property_id : '#' }}" target="_blank">
                                                View
                                            </a>
                                        @else
                                        Contact
                                        @endif
                                        </td>
                                        <td>
                                            <div class="mb-3">
                                                <select class="form-control" id="lead_status{{ $lead->id }}" name="lead_status" onchange="statusUpdateLead('{{ $lead->id }}');">
                                                    <option value="1" {{ ($lead->lead_status == 1) ? 'selected' : '' ;  }} @if(Auth::user()->role_id != 1) @disabled(true) @endif>Open</option>
                                                    <option value="2" {{ ($lead->lead_status == 2) ? 'selected' : '' ;  }}>Close</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>{{ $loan_status }}</td>
                                        <td>
                                            <a href="{{ route('lead.view', $lead->id) }}" class="text-success me-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" class="text-success me-2" data-bs-toggle="modal" data-bs-target="#myModal" onclick="OpenAssignModal('{{ Auth::user()->id }}','{{ $lead->id }}','{{ $lead->user_id }}');">
                                                <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" class="text-secondary me-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalRight" onclick="ViewrightModal({{ $lead->id }})">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                             <form action="{{ route('enquiry.destroy', $lead->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this lead?');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right_modal">
        <!-- Right Modal -->
        <div class="modal fade drawer right-align" id="exampleModalRight" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Right Align Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="job-tracking-vertical">



                        </div>
                    </div>


                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Modal Title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Modal content with select option -->
            <form>
                <div class="mb-3">
                <input type="hidden" id="current_lead_id">
                <input type="hidden" id="current_user_id">
                <input type="hidden" id="lead_create_user_id">
                <label for="selectOption" class="form-label">Select User</label>
                <select id="selectOption" class="form-select" aria-label="Default select example">
                    <option value="">Select User</option>
                    @foreach ( $get_user as $user )
                        <option value="{{ $user->id }}">{{ $user->name }} ( {{ $user->role_name }})</option>
                    @endforeach
                </select>
                </div>
                <span class="assign_error text-danger"></span>
                <span class="assign_success text-success"></span>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AssignLead();">Save changes</button>
            </div>
        </div>
        </div>
    </div>


@endsection
