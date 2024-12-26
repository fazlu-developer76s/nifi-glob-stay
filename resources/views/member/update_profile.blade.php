@extends('layouts.app')
@section('content')

@if(isset($get_member))
    @php $form_action = "member.update" @endphp
    <h2 class="page-header">Update Profile</h2>
@else
    @php $form_action = "member.create" @endphp
    <h2 class="page-header">Create Member</h2>
@endif

<div class="container-fluid">
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Member</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> {{ isset($get_member) ? 'Update' : 'Update' }} Profile</li>
                </ol>
            </div>
        </div>

        <!-- Profile Form Section -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card border-0 mb-4 shadow">
                    <div class="card-header bg-light p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-user-circle fa-lg text-primary me-2"></i>
                                <strong>{{ isset($get_member) ? 'Update Profile' : 'Update Profile' }}</strong>
                            </div>
                            {{-- <a href="{{ route('member') }}">
                                <button class="btn btn-outline-secondary">Back to Member List</button>
                            </a> --}}
                        </div>
                    </div>
                    <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hidden_id" value="{{ isset($get_member) ? $get_member->id : '' }}">
                        <input type="hidden" name="role_id" value="{{ isset($get_member) ? $get_member->role_id : '' }}">
                        <input type="hidden" name="status" value="{{ isset($get_member) ? $get_member->status : '' }}">
                        <input type="hidden" name="redirect" value="update_profile">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter Name" value="@if(empty($get_member)) {{ old('name') }} @else {{ (isset($get_member)) ? $get_member->name : '' ; }} @endif"  />
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter Email" value=" @if(empty($get_member)) {{ old('email') }} @else {{ (isset($get_member)) ? $get_member->email : '' ; }} @endif"  />
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No.</label>
                                        <input class="form-control @error('mobile_no') is-invalid @enderror" type="text" name="mobile_no" placeholder="Enter Mobile No." value="@if(empty($get_member)) {{ old('mobile_no') }} @else {{ (isset($get_member)) ? $get_member->mobile_no : '' ; }} @endif"  />
                                        @error('mobile_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Picture</label>
                                        <input class="form-control @error('profile_picture') is-invalid @enderror" type="file" name="profile_picture" accept="image/*" />
                                        @if(isset($get_member) &&!empty($get_member->image))
                                        <div class="form-text">Current Profile Picture: <img src="{{ asset('storage/'. $get_member->image) }}" alt="Profile Picture" width="100"></div>
                                        @endif
                                        @error('profile_picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-light p-3 text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
