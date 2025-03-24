@extends('layouts/app')
@section('content')
@if(isset($get_notification))
@php $form_action = "notification.update" @endphp
@else
@php $form_action = "notification.create" @endphp
@endif
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;"> Notification</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create  Notification</li>
                    </ol>
                    <h1 class="page-header mb-0"> Notification</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add  Notification
                            </div>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ isset($get_notification) ? $get_notification->id : '' }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Users</label>
                                            <select class="form-control @error('user_ids') is-invalid @enderror" name="user_ids[]" multiple>
                                                @foreach($get_users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ (is_array(old('user_ids')) && in_array($user->id, old('user_ids'))) ? 'selected' : '' }}
                                                        {{ isset($get_notification) && in_array($user->id, $get_notification->user_ids ?? []) ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_ids')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <!-- Subject -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subject</label>
                                            <input class="form-control @error('subject') is-invalid @enderror" type="text" name="subject" placeholder="Enter Subject"
                                                value="{{ isset($get_notification) ? $get_notification->subject : old('subject') }}" />
                                            @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="editor" placeholder="Enter Message">{{ isset($get_notification) ? $get_notification->message : old('message') }}</textarea>
                                            @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date</label>
                                            <input class="form-control @error('date') is-invalid @enderror" type="date" name="date"
                                                value="{{ isset($get_notification) ? $get_notification->date : old('date') }}" />
                                            @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Time -->
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Time</label>
                                            <input class="form-control @error('time') is-invalid @enderror" type="time" name="time"
                                                value="{{ isset($get_notification) ? $get_notification->time : old('time') }}" />
                                            @error('time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control custom-select-icon @error('status') is-invalid @enderror" name="status">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }} {{ isset($get_notification) && $get_notification->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }} {{ isset($get_notification) && $get_notification->status == 2 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-none d-flex p-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Table Section -->
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                             Notification List
                        </div>
                        <div class="card-body">
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">Users</th>
                                        <th class="text-nowrap">Subject</th>
                                        <th class="text-nowrap">Message</th>
                                        {{-- <th class="text-nowrap">Date</th> --}}
                                        {{-- <th class="text-nowrap">Time</th> --}}
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if($allnotification)
                                    @foreach ($allnotification as $notification)

                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration  }}</td>
                                        {{-- <td>
                                            <img src="{{ Storage::url($notification->image) }}" alt="" class="img-fluid" style="max-width: 30px; height: auto;" />
                                        </td> --}}
                                        <td>
                                            @foreach ($notification['user'] as $key => $value)
                                                {{ $value->user_name  }},
                                            @endforeach
                                        </td>

                                        <td>{{ $notification->subject }}</td>
                                        <td>{{ strip_tags($notification->message) }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($notification->date)->format('d F Y') }}</td> --}}
                                        {{-- <td>{{ \Carbon\Carbon::parse($notification->time)->format('h:i A') }}</td> --}}
                                        <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d F Y h:i A') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $notification->id }}" {{ ($notification->status == 1) ? 'checked' : '' }} onchange="ChangeStatus('tbl_notification',{{ $notification->id }});" >
                                            </div>
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('notification.edit', $notification->id) }}" class="text-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a> --}}
                                            <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" style="display: inline;">
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
