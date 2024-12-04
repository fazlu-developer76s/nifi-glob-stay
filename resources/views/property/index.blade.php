@extends('layouts/app')
@section('content')
@if(isset($get_property))
@php $form_action = "property.update" @endphp
@else
@php $form_action = "property.create" @endphp
@endif
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;"> Property</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create  Property</li>
                    </ol>
                    <h1 class="page-header mb-0"> Property</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <!-- Table Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Property List
                            <a href="{{ route('property.create') }}" class="ms-auto">
                                <button class="btn btn-primary">Create Property</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">Category Name</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">State</th>
                                        <th class="text-nowrap">Place</th>

                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($allproperty)
                                    @foreach ($allproperty as $property)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                        <td>{{ $property->category_name }}</td>
                                        <td>{{ $property->hotel_name }}</td>
                                        <td>{{ $property->state }}</td>
                                        <td>{{ $property->place }}</td>
                                        <td>{{ \Carbon\Carbon::parse($property->created_at)->format('d F Y h:i A') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $property->id }}" {{ ($property->status == 1) ? 'checked' : '' }} onchange="ChangeStatus('properties',{{ $property->id }});" >
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('property.edit', $property->id) }}" class="text-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('property.destroy', $property->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this route?');">
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
@endsection
