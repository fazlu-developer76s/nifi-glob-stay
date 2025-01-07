@extends('layouts/app')
@section('content')
@if(isset($hotel))
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
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add  Property
                            </div>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ isset($hotel) ? $hotel->id : '' }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Category</label>
                                            <select class="form-control custom-select-icon @error('category_id') is-invalid @enderror" name="category_id" id="category_id" onchange="AddProperty()">
                                                <option value="">Select Role</option>
                                                @if($get_category)
                                                    @foreach ($get_category as $category)
                                                        <option value="{{ $category->id }}"  {{ (request('id') == $category->id) ? 'selected' : '' }}  @if(empty($hotel)) {{ old('category_id') == $category->id ? 'selected' : '' }} @else {{ (isset($hotel) && $hotel->category_id == $category->id) ? 'selected' : '' ; }} @endif>{{ $category->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Name</label>
                                            <input class="form-control @error('hotel_name') is-invalid @enderror" type="text" name="hotel_name" placeholder="Enter  Name" value="{{ old('hotel_name', $hotel->hotel_name ?? '') }}" />
                                            @error('hotel_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Address</label>
                                            <textarea class="form-control @error('hotel_address') is-invalid @enderror" name="hotel_address" placeholder="Enter  Address">{{ old('hotel_address', $hotel->hotel_address ?? '') }}</textarea>
                                            @error('hotel_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Description</label>
                                            <textarea class="form-control @error('hotel_description') is-invalid @enderror" name="hotel_description" placeholder="Enter  Description">{{ old('hotel_description', $hotel->hotel_description ?? '') }}</textarea>
                                            @error('hotel_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Map Link</label>
                                            <input class="form-control @error('hotel_map_link') is-invalid @enderror" type="text" name="hotel_map_link" placeholder="Enter Map Link" value="{{ old('hotel_map_link', $hotel->hotel_map_link ?? '') }}" />
                                            @error('hotel_map_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Youtube Link</label>
                                            <input class="form-control @error('youtube_link') is-invalid @enderror" type="text" name="youtube_link" placeholder="Enter Youtube Link" value="{{ old('youtube_link', $hotel->youtube_link ?? '') }}" />
                                            @error('youtube_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Rating</label>
                                            <input class="form-control @error('rating') is-invalid @enderror" type="number" name="rating" placeholder="Enter Rating Link" value="{{ old('rating', $hotel->rating ?? '') }}" />
                                            @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input class="form-control @error('state') is-invalid @enderror" type="text" name="state" placeholder="Enter State" value="{{ old('state', $hotel->state ?? '') }}" />
                                            @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Price (Per Day)</label>
                                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" placeholder="Enter Price" value="{{ old('price', $hotel->price ?? '') }}" />
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Booking Days</label>
                                            <input class="form-control @error('booking_days') is-invalid @enderror" type="text" name="booking_days" placeholder="Enter Booking Days" value="{{ old('booking_days', $hotel->booking_days ?? '') }}" />
                                            @error('booking_days')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Distance</label>
                                            <input class="form-control @error('distance') is-invalid @enderror" type="text" name="distance" placeholder="Enter Distance" value="{{ old('distance', $hotel->distance ?? '') }}" />
                                            @error('distance')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Location</label>
                                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" placeholder="Enter Location" value="{{ old('location', $hotel->location ?? '') }}" />
                                            @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                  <div class="row g-3">
                                    <!-- Thumbnail Image Upload -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Thumbnail Image</label>
                                            <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" />
                                            @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <!-- Display Existing Thumbnail -->
                                        @if(!empty($hotel->hotel_image))
                                        <div class="mb-4 text-center">
                                            <img src="{{ asset('storage/'. $hotel->hotel_image) }}" class="img-thumbnail" alt="Hotel Thumbnail" style="max-width: 150px; height: auto;">
                                        </div>
                                        @endif
                                    </div>
                                
                                    <!-- Multiple Images Upload -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Additional Images</label>
                                            <input class="form-control @error('hotel_images.*') is-invalid @enderror" type="file" name="hotel_images[]" multiple />
                                            @error('hotel_images.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                
                                        <!-- Display Existing Images -->
                                        @if(!empty($hotel->images))
                                        <div class="row g-2">
                                            @foreach($hotel->images as $img)
                                            <div class="col-4 col-md-3 col-lg-2 position-relative">
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="cursor: pointer;" onclick="Deletesubimage('{{ $img->id }}')">
                                                    &times;
                                                </span>
                                                <img src="{{ asset('storage/'. $img->image) }}" class="img-thumbnail" alt="Hotel Image" style="width: 100%; height: auto;">
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                    
                                    <hr>
                                    <h2>Add Facilities</h2>
                                    <div class="row">
                                    @foreach ($get_facilities as $faci)
                                        <div class="col-md-2">
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
                                    <hr>
                                    <h2>Add Amenities</h2>
                                    <div class="row">
                                    @foreach ($get_amenities as $ament)
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <input class="@error('amenities') is-invalid @enderror" type="checkbox" name="amenities[]" value="{{ $ament->id }}" id="checkament{{ $ament->id }}" {{ ($ament->selected==1)?'checked':''; }}/>
                                                <label class="form-label" for="checkament{{ $ament->id }}">{{ $loop->iteration }}.</label>
                                                <label class="form-label"for="checkament{{ $ament->id }}">{{ $ament->title }}</label>
                                                @error('amenities')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer bg-none d-flex p-3">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>
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

    function Deletesubimage(id){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('delete.image') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                id: id,
            },
            success: function(response) {
                if(response==1){
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while saving the note.");
            }
        });
    }
</script>

<script>
    function  AddProperty(){
        let get_category_id = $("#category_id").val()
        if( get_category_id == 1 ){
            const url = "{{ route('book.property.create') }}?id="+get_category_id+"";
            window.location.href = url; // Redirect to the generated URL
        }
    }
</script>
