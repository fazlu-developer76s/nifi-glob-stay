@extends('layouts/app')
@section('content')
@if(isset($get_property))
    @php $form_action = "property.update"; @endphp
@else
    @php $form_action = "property.create"; @endphp
@endif
@inject('helper', 'App\Helpers\Global_helper')
@php
    $create = $helper->getRolePermissions(Auth::user()->role_id, 'Create Listing');
    $view = $helper->getRolePermissions(Auth::user()->role_id, 'View Listing');
    $update = $helper->getRolePermissions(Auth::user()->role_id, 'Update Listing');
    $approved = $helper->getRolePermissions(Auth::user()->role_id, 'Approved Listing');
    $delete = $helper->getRolePermissions(Auth::user()->role_id, 'Deleted Listing');
@endphp

    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;"> Bookings</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create  Bookings</li>
                    </ol>
                    <h1 class="page-header mb-0"> Bookings</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <!-- Table Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Bookings List

                        </div>
                        <div class="card-body">
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>

                                        <th>Room No</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Guest Number</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Booking Days</th>
                                        <th>Booking Price</th>
                                        <th>Final Amount</th>
                                        <th>Tax</th>
                                        <th>Booking Status</th>
                                        <th>Hotel Category ID</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Hotel Name</th>
                                        <th>User Name</th>
                                        <th>Razorpay Payment ID</th>
                                        <th>Razorpay Order ID</th>
                                        <th>Razorpay Method</th>
                                        <th>Razorpay Amount</th>
                                        <th>Razorpay Currency</th>
                                        <th>Razorpay Status</th>
                                        <th>Razorpay Response</th>
                                        <th>Razorpay Created At</th>
                                        <th>Category Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allproperty as $property)
                                    @php
                                    switch($property->booking_status) {
                                        case 1:
                                            $statusText = 'Open';
                                            break;
                                        case 2:
                                            $statusText = 'Booked';
                                            break;
                                        case 3:
                                            $statusText = 'Check-In';
                                            break;
                                        case 4:
                                            $statusText = 'Checkout';
                                            break;
                                        case 5:
                                            $statusText = 'Ready to Checkout';
                                            break;
                                        case 6:
                                            $statusText = 'Completed';
                                            break;
                                        default:
                                            $statusText = 'Unknown';
                                    }
                                @endphp
                                        <tr>

                                            <td>{{ $property->room_no }}</td>
                                            <td>{{ $property->check_in }}</td>
                                            <td>{{ $property->check_out }}</td>
                                            <td>{{ $property->guest_num }}</td>
                                            <td>{{ $property->name }}</td>
                                            <td>{{ $property->email }}</td>
                                            <td>{{ $property->mobile }}</td>
                                            <td>{{ $property->booking_days }}</td>
                                            <td>{{ $property->booking_price }}</td>
                                            <td>{{ $property->final_amount }}</td>
                                            <td>{{ $property->tax }}</td>
                                            <td>{{ $statusText }}</td>
                                            <td>{{ $property->hotel_category_id }}</td>
                                            <td>{{ $property->created_at }}</td>
                                            <td>{{ $property->updated_at }}</td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->user_name }}</td>
                                            <td>{{ $property->raz_payment_id }}</td>
                                            <td>{{ $property->raz_order_id }}</td>
                                            <td>{{ $property->raz_method }}</td>
                                            <td>{{ $property->raz_amount }}</td>
                                            <td>{{ $property->raz_currency }}</td>
                                            <td>{{ $property->raz_status }}</td>
                                            <td>{{ $property->raz_response }}</td>
                                            <td>{{ $property->raz_created_at }}</td>
                                            <td>{{ $property->category_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
