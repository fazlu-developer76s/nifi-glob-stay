@extends('layouts/app')
@section('content')
    <div class="container-fluid">
        {{-- <div class="row"> --}}
            <div id="content" class="app-content">
                <div class="d-flex align-items-center mb-3">
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:;">Permission Category</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Permission Category</li>
                        </ol>
                        <h1 class="page-header mb-0">Permission Category</h1>
                    </div>
                </div>

                <!-- Row for equal division -->
                <div class="row">
                    <!-- Form Section -->
                    <div class="col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-header h6 mb-0 bg-none p-3">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add Permission Category
                            </div>
                            <form action="{{ route('store.permission_category') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                @if(isset($find_permission_category) && $find_permission_category->id)
                                                <input type="hidden" name="hidden_id" value="{{ $find_permission_category->id }}">
                                                @endif
                                                <label class="form-label">Permission Category</label>
                                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter Permission Category Title" value="{{ ( isset($find_permission_category)  && $find_permission_category->id) ? $find_permission_category->category_name : ' ' ; }} {{ old('title') }}"  />
                                                   <!-- Display Error Message Below the Input Field -->
                                                    @error('title')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                           </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control custom-select-icon" name="status">
                                                        <option value="1" {{ ( isset($find_permission_category) && $find_permission_category->status == 1)?'selected':''; }}>Active</option>
                                                        <option value="2" {{ ( isset($find_permission_category) && $find_permission_category->status == 2)?'selected':''; }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-none d-flex p-3">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>Submit</button>
                                    {{-- <button type="reset" class="btn btn-danger ms-2">RESET</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-header h6 mb-0 bg-none p-3" style="border-bottom: 1px solid #2196f3;">
                                <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Permission Category List
                            </div>
                            <div class="card-body">
                                <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th width="1%"></th>
                                            <th class="text-nowrap">Permission Category</th>
                                            <th class="text-nowrap">Created Date</th>
                                            <th class="text-nowrap">Status</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($get_permission_category)
                                        @foreach($get_permission_category as $permission_category)
                                        <tr class="odd gradeX">
                                            <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>
                                            <td>{{ $permission_category->category_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($permission_category->created_at)->format('d F Y h:i A') }}</td>

                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $permission_category->id }}" {{ ($permission_category->status==1) ? 'checked' : '' }}  onchange="ChangeStatus('permission_category',{{ $permission_category->id }});" >
                                                  </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.permission_category', $permission_category->id) }}" class="text-primary me-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('destroy.permission_category', $permission_category->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this permission_category?');">
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
        {{-- </div> --}}
    </div>
@endsection
