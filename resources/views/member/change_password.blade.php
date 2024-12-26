@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Member</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Update Password</li>
                </ol>
            </div>
        </div>

        <!-- Password Update Form Section -->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card border-0 mb-4 shadow">
                    <div class="card-header bg-light p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-key fa-lg text-primary me-2"></i>
                                <strong>Update Password</strong>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input class="form-control @error('current_password') is-invalid @enderror"
                                       type="password"
                                       name="current_password"
                                       placeholder="Enter Current Password" />
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input class="form-control @error('new_password') is-invalid @enderror"
                                       type="password"
                                       name="new_password"
                                       placeholder="Enter New Password" />
                                @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
