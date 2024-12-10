@extends('layouts/app')

@section('content')
<style>
    strong {
        font-weight: bold;
    }

    .lead-status-badge {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 12px;
    }

    .info_div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .first_div {
        flex: 0 0 40%;
        text-align: left;
    }

    .second_div {
        flex: 0 0 55%;
        text-align: left;
    }

    .container-fluid {
        padding: 0 2rem;
    }

    .page-header {
        margin-bottom: 1rem;
    }

    .breadcrumb-item {
        font-size: 0.9rem;
    }

    .card {
        margin-bottom: 2rem;
    }

    .card-header {
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    @media (max-width: 768px) {
        .info_div {
            flex-direction: column;
            text-align: left;
        }

        .second_div {
            text-align: left;
            margin-top: 0.5rem;
        }
    }
</style>

    @if (isset($get_lead))
        @php $form_action = "lead.update"; @endphp
    @else
        @php $form_action = "lead.create"; @endphp
    @endif
    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" id="lead_id" value="{{ isset($get_lead) ? @$get_lead->id : ' ' }}">
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;">Enquiry</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Enquiry</li>
                    </ol>
                    <h1 class="page-header mb-0">Enquiry</h1>
                </div>
            </div>

            <!-- Row for equal division -->
            <div class="row">
                <!-- Form Section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Enquiry Information</h4>
                        </div>

                        @switch(@$get_lead->loan_status)
                            @case(1)
                                @php $loan_status = "Pending"; @endphp
                            @break

                            @case(2)
                                @php $loan_status = "View"; @endphp
                            @break

                            @case(3)
                                @php $loan_status = "Under_Discussion"; @endphp
                            @break

                            @case(4)
                                @php $loan_status = "Pending_Kyc"; @endphp
                            @break

                            @case(5)
                                @php $loan_status = "Qualified"; @endphp
                            @break

                            @case(6)
                                @php $loan_status = "Rejected"; @endphp
                            @break

                            @default
                                @php $loan_status = "Unknown"; @endphp
                        @endswitch
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>

                                            <tr>
                                                {{-- <h4>Customer Information</h4> --}}
                                                <td><strong>Full Name:</strong></td>
                                                <td>{{ ucwords(@$get_lead->name ?? 'N/A') }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>Mobile No:</strong></td>
                                                <td>{{ @$get_lead->mobile_no ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Location:</strong></td>
                                                <td>{{ @$get_lead->location ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Plan Date:</strong></td>
                                                <td>{{ (!empty($get_lead->plan_date)) ? date('d-m-Y',strtotime($get_lead->plan_date)) : '' ; }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Created At:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse(@$get_lead->created_at)->format('d F Y h:i A') ?? 'N/A' }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tbody>

                                            <tr>
                                                {{-- <h4 >Occupation Details</h4> --}}
                                                <td><strong>Email:</strong></td>
                                                <td>{{ ucwords(@$get_lead->email ?? 'N/A') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Message:</strong></td>
                                                <td>{{ @$get_lead->message ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Budget:</strong></td>
                                                <td>{{ @$get_lead->budget ?? 'N/A' }}  </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Lead Status:</strong></td>
                                                <td>{{ @$get_lead->loan_status ?? 'N/A' }}</td>
                                            </tr>
                                            @if(!empty($get_lead->property_id))
                                            <tr>
                                                <td><strong>Property Link:</strong></td>
                                                <td>
                                                    <a href="{{ $get_lead->property_id ? 'https://globstay-updates.vercel.app/details/' . $get_lead->property_id : '#' }}" target="_blank">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

                    <div class="col-md-8">


                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Activity Log</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="note_html">
                            <!-- Notes will be appended here dynamically -->
                        </ul>
                        @if ( @$get_lead->loan_status == 2)
                            <button class="btn btn-outline-primary mt-5"
                                onclick="startDisscussion({{ isset($get_lead->id) ? @$get_lead->id : ' ' }}, {{ Auth::user()->id }}, '');">Proceed</button>
                        @endif
                    </div>
                </div>
            </div>

            @if (
                    (Auth::user()->role_id == 1 || $get_assign_id->assign_user_id == Auth::user()->id) &&
                    @$get_lead->loan_status >= 3
                )

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h4 class="mb-0">Notes</h4>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" >
                                @csrf
                                <!-- Textarea Field -->
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter your notes here"></textarea>

                                    <input type="hidden" id="hidden_id">
                                </div>
                                <!-- Select Field -->
                                <div class="mb-3">
                                    <label for="option" class="form-label">Select Status</label>
                                    <select class="form-select" id="status" name="option">
                                        <option selected value="">Select an option</option>
                                        <option value="3" {{ @$get_lead->loan_status == 3 ? 'selected' : '' }}>Under Processing</option>
                                        <option value="4" {{ @$get_lead->loan_status == 4 ? 'selected' : '' }}>Move to Lender</option>
                                        <option value="5" {{ @$get_lead->loan_status == 5 ? 'selected' : '' }}>Sanction</option>
                                        <option value="6" {{ @$get_lead->loan_status == 6 ? 'selected' : '' }}>Disbursed</option>
                                        <option value="7" {{ @$get_lead->loan_status == 7 ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <span type="submit" class="btn btn-primary" onclick="return SaveNotes();">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
