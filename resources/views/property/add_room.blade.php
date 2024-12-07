@extends('layouts/app')

@section('content')
@php
    $formAction = isset($find_data) ? 'amenities.update' : 'book.add.room';
@endphp

<div class="container-fluid">
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Floor</a></li>
                    <li class="breadcrumb-item active">Create Floor</li>
                </ol>
                <h1 class="page-header mb-0">Floor</h1>
            </div>
        </div>

        <div class="row">
            <!-- Form Section -->
            <div class="col-md-6">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                        <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                        Add Floor
                    </div>

                    <form action="{{ route($formAction , ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($find_data))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="hidden_id" value="{{ $find_data->id ?? '' }}">
                        <input type="hidden" name="property_id" value="{{ $id ?? '' }}">

                        <div class="card-body">
                            <div class="row">
                                <!-- Floor Number -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Floor Number</label>
                                        <input type="text"
                                               class="form-control @error('flor_no') is-invalid @enderror"
                                               name="flor_no"
                                               placeholder="Enter Floor Number"
                                               value="{{ old('flor_no', $find_data->flor_no ?? '') }}">
                                        @error('flor_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Room Number -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Room Number</label>
                                        <input type="number"
                                               class="form-control @error('room_no') is-invalid @enderror"
                                               name="room_no"
                                               placeholder="Enter Room Number"
                                               value="{{ old('room_no', $find_data->room_no ?? '') }}">
                                        @error('room_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bed Type -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Bed Type</label>
                                        <select class="form-control @error('bed_id') is-invalid @enderror"
                                                name="bed_id">
                                            <option value="">Select Bed Type</option>
                                            @foreach ($get_bed as $bed)
                                                <option value="{{ $bed->id }}"
                                                    {{ old('bed_id', $find_data->bed_id ?? '') == $bed->id ? 'selected' : '' }}>
                                                    {{ $bed->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('bed_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                                            <option value="1" {{ old('status', $find_data->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ old('status', $find_data->status ?? 1) == 2 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Facilities -->
                            <h2>Add Facilities</h2>
                            <div class="row">
                                @foreach ($get_facilities as $faci)
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <input class="@error('facilities') is-invalid @enderror" type="checkbox" name="facilities[]" value="{{ $faci->id }}" id="checkfac{{ $faci->id }}" onchange="removeClasscheck('{{ $faci->id }}')" {{ ($faci->selected==1)?'checked':''; }}/>
                                                <label class="form-label" for="checkfac{{ $faci->id }}">{{ $loop->iteration }}.</label>
                                                <label class="form-label"for="checkfac{{ $faci->id }}">{{ $faci->title }}</label>
                                                @error('facilities')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <input class="form-control @error('number') is-invalid @enderror checkclass{{ $faci->id }}  {{ ($faci->selected!=1)?'d-none':''; }} " type="number" name="number[]" value="{{ ($faci->selected==1)? $faci->value :''; }}"  />
                                            </div>
                                        </div>

                                    @endforeach
                            </div>

                            <!-- Floor -->
                            <h2>Add Floor</h2>
                            <div class="row">
                                @foreach ($get_amenities as $amenity)
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <input type="checkbox"
                                                   name="amenities[]"
                                                   value="{{ $amenity->id }}"
                                                   id="amenity_{{ $amenity->id }}"
                                                   {{ $amenity->selected ? 'checked' : '' }}>
                                            <label for="amenity_{{ $amenity->id }}">{{ $amenity->title }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer d-flex p-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>

                <!-- Table Section -->
                <div class="col-md-6">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex align-items-center" style="border-bottom: 1px solid #2196f3;">
                            <i class="fab fa-buromobelexperte fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                            Floor List
                        </div>
                        <div class="card-body">
                            <table id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th class="text-nowrap">Flor No.</th>
                                        <th class="text-nowrap">Room No.</th>
                                        <th class="text-nowrap">Bed</th>
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($allflor)
                                    @foreach ($allflor as $flor)
                                    <tr class="odd gradeX">
                                        <td width="1%" class="fw-bold text-dark">{{ $loop->iteration }}</td>

                                        <td>{{ $flor->flor_no }}</td>
                                        <td>{{ $flor->room_no }}</td>
                                        <td>{{ $flor->bed_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($flor->created_at)->format('d F Y h:i A') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{ $flor->id }}" {{ ($flor->status==1) ? 'checked' : '' }}  onchange="ChangeStatus('amenities',{{ $flor->id }});" >
                                              </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('amenities.edit', $flor->id) }}" class="text-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('amenities.destroy', $flor->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this amenities?');">
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
<script>
     function removeClasscheck(id){
        let create_class = "checkclass" + id;
        let create_id = "checkfac" + id;
        if($("#" + create_id).prop('checked')) { // Check if the checkbox is checked
            $("." + create_class).removeClass("d-none");
        } else {
            $("." + create_class).addClass("d-none");
        }
    }
</script>
