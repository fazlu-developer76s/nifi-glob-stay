@extends('layouts/app')
@section('content')
    @if (isset($hotel))
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
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create Property</li>
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
                                Add Property
                            </div>
                        </div>
                    </div>
                    <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ isset($hotel) ? $hotel->id : '' }}" name="hidden_id">



                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select
                                                        class="form-control custom-select-icon @error('category_id') is-invalid @enderror"
                                                        name="category_id" id="category_id" onchange="AddProperty()">
                                                        <option value="">Select Category</option>
                                                        @if ($get_category)
                                                            @foreach ($get_category as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ request('id') == $category->id ? 'selected' : '' }}
                                                                    @if (empty($hotel)) {{ old('category_id') == $category->id ? 'selected' : '' }} @else {{ isset($hotel) && $hotel->category_id == $category->id ? 'selected' : '' }} @endif>
                                                                    {{ $category->title }}</option>
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
                                                    <label class="form-label">Property Category</label>
                                                    <select
                                                        class="form-control custom-select-icon @error('property_category_id') is-invalid @enderror"
                                                        name="property_category_id" id="property_category_id"
                                                        onchange="AddProperty()">
                                                        <option value="">Select Property Category</option>
                                                        @if ($get_propertycategory)
                                                            @foreach ($get_propertycategory as $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if (empty($hotel)) {{ old('property_category_id') == $category->id ? 'selected' : '' }} @else {{ isset($hotel) && $hotel->property_category_id == $category->id ? 'selected' : '' }} @endif>
                                                                    {{ $category->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('property_category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input class="form-control @error('hotel_name') is-invalid @enderror"
                                                        type="text" name="hotel_name" placeholder="Enter Name"
                                                        value="{{ old('hotel_name', $hotel->hotel_name ?? '') }}" />
                                                    @error('hotel_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label>
                                                    <select class="form-control @error('rating') is-invalid @enderror"
                                                        name="rating">
                                                        <option value="">Select Rating</option>
                                                        <option value="1"
                                                            {{ old('rating', $hotel->rating ?? '') == 1 ? 'selected' : '' }}>
                                                            1</option>
                                                        <option value="2"
                                                            {{ old('rating', $hotel->rating ?? '') == 2 ? 'selected' : '' }}>
                                                            2</option>
                                                        <option value="3"
                                                            {{ old('rating', $hotel->rating ?? '') == 3 ? 'selected' : '' }}>
                                                            3</option>
                                                        <option value="4"
                                                            {{ old('rating', $hotel->rating ?? '') == 4 ? 'selected' : '' }}>
                                                            4</option>
                                                        <option value="5"
                                                            {{ old('rating', $hotel->rating ?? '') == 5 ? 'selected' : '' }}>
                                                            5</option>
                                                    </select>
                                                    @error('rating')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control @error('hotel_address') is-invalid @enderror" name="hotel_address"
                                                        placeholder="Enter Address">{{ old('hotel_address', $hotel->hotel_address ?? '') }}</textarea>
                                                    @error('hotel_address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control @error('hotel_description') is-invalid @enderror" name="hotel_description"
                                                        placeholder="Enter Description">{{ old('hotel_description', $hotel->hotel_description ?? '') }}</textarea>
                                                    @error('hotel_description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Youtube Link</label>
                                                    <input class="form-control @error('youtube_link') is-invalid @enderror"
                                                        type="text" name="youtube_link" placeholder="Enter Youtube Link"
                                                        value="{{ old('youtube_link', $hotel->youtube_link ?? '') }}" />
                                                    @error('youtube_link')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Location</label>
                                                    <input class="form-control @error('location') is-invalid @enderror"
                                                        type="text" name="location" placeholder="Enter Location"
                                                        value="{{ old('location', $hotel->location ?? '') }}" />
                                                    @error('location')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Thumbnail Image Upload -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Thumbnail Image</label>
                                                    <input class="form-control @error('thumbnail') is-invalid @enderror"
                                                        type="file" name="thumbnail" />
                                                    @error('thumbnail')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Display Existing Thumbnail -->
                                                @if (!empty($hotel->hotel_image))
                                                    <div class="mb-4 text-center">
                                                        <img src="{{ asset('storage/' . $hotel->hotel_image) }}"
                                                            class="img-thumbnail" alt="Hotel Thumbnail"
                                                            style="max-width: 150px; height: auto;">
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Multiple Images Upload -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Additional Images</label>
                                                    <input
                                                        class="form-control @error('hotel_images.*') is-invalid @enderror"
                                                        type="file" name="hotel_images[]" multiple />
                                                    @error('hotel_images.*')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <!-- Display Existing Images -->
                                                @if (!empty($hotel->images))
                                                    <div class="row g-2">
                                                        @foreach ($hotel->images as $img)
                                                            <div class="col-4 col-md-3 col-lg-2 position-relative">
                                                                <span
                                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                                    style="cursor: pointer;"
                                                                    onclick="Deletesubimage('{{ $img->id }}')">
                                                                    &times;
                                                                </span>
                                                                <img src="{{ asset('storage/' . $img->image) }}"
                                                                    class="img-thumbnail" alt="Hotel Image"
                                                                    style="width: 100%; height: auto;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h2>Property Info</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- District Dropdown -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">District</label>
                                                    <select
                                                        class="form-control @error('district_tehsil') is-invalid @enderror"
                                                        name="district_tehsil">
                                                        <option value="">Select District</option>
                                                        <option value="District 1"
                                                            {{ old('district_tehsil', $hotel->district_tehsil ?? '') == 'District 1' ? 'selected' : '' }}>
                                                            District 1</option>
                                                        <option value="District 2"
                                                            {{ old('district_tehsil', $hotel->district_tehsil ?? '') == 'District 2' ? 'selected' : '' }}>
                                                            District 2</option>
                                                        <option value="District 3"
                                                            {{ old('district_tehsil', $hotel->district_tehsil ?? '') == 'District 3' ? 'selected' : '' }}>
                                                            District 3</option>
                                                    </select>
                                                    @error('district_tehsil')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Zipcode Input -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Zipcode</label>
                                                    <input type="text"
                                                        class="form-control @error('zipcode') is-invalid @enderror"
                                                        name="zipcode" placeholder="Enter Zipcode"
                                                        value="{{ old('zipcode', $hotel->zipcode ?? '') }}" />
                                                    @error('zipcode')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- City/Village Input -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">City/Village</label>
                                                    <input type="text"
                                                        class="form-control @error('city_village') is-invalid @enderror"
                                                        name="city_village" placeholder="Enter City or Village"
                                                        value="{{ old('city_village', $hotel->city_village ?? '') }}" />
                                                    @error('city_village')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Area Size Input -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Area Size (in Sq. Ft.)</label>
                                                    <input type="number"
                                                        class="form-control @error('area_size') is-invalid @enderror"
                                                        name="area_size" placeholder="Enter Area Size"
                                                        value="{{ old('area_size', $hotel->area_size ?? '') }}" />
                                                    @error('area_size')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Site Specification (Description) -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Site Specification (Description)</label>
                                                    <textarea class="form-control @error('site_specification') is-invalid @enderror" name="site_specification"
                                                        rows="4" placeholder="Enter site description">{{ old('site_specification', $hotel->site_specification ?? '') }}</textarea>
                                                    @error('site_specification')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h2>Pricing Info</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Price Input -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input class="form-control @error('price') is-invalid @enderror"
                                                        type="text" name="price" placeholder="Enter Price"
                                                        value="{{ old('price', $hotel->price ?? '') }}" />
                                                    @error('price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Markup Dropdown -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Markup (%)</label>
                                                    <select class="form-control @error('markup') is-invalid @enderror"
                                                        name="markup">
                                                        <option value="">Select Markup</option>
                                                        @for ($i = 0; $i <= 100; $i += 5)
                                                            <option value="{{ $i }}"
                                                                {{ old('markup', $hotel->markup ?? '') == $i ? 'selected' : '' }}>
                                                                {{ $i }}%</option>
                                                        @endfor
                                                    </select>
                                                    @error('markup')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Markup Value B2C -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Markup Value B2C</label>
                                                    <input
                                                        class="form-control @error('markup_value_b2c') is-invalid @enderror"
                                                        type="text" name="markup_value_b2c" placeholder="Enter Price"
                                                        value="{{ old('markup_value_b2c', $hotel->markup_value_b2c ?? '') }}" />
                                                    @error('markup_value_b2c')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Markup Value B2B -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Markup Value B2B</label>
                                                    <input
                                                        class="form-control @error('markup_value_b2b') is-invalid @enderror"
                                                        type="text" name="markup_value_b2b" placeholder="Enter Price"
                                                        value="{{ old('markup_value_b2b', $hotel->markup_value_b2b ?? '') }}" />
                                                    @error('markup_value_b2b')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h2>Extra Info</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Total Area In</label>
                                                    <input type="number"
                                                        class="form-control @error('extra_info_area_size') is-invalid @enderror"
                                                        name="extra_info_area_size" placeholder="Enter Area Size"
                                                        value="{{ old('extra_info_area_size', $hotel->extra_info_area_size ?? '') }}" />
                                                    @error('extra_info_area_size')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Area Size Type</label>
                                                    <select
                                                        class="form-control @error('extra_info_area_size_type') is-invalid @enderror"
                                                        name="extra_info_area_size_type">
                                                        <option value="">Select Area Size Type</option>
                                                        <option value="nali"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'nali' ? 'selected' : '' }}>
                                                            Nali</option>
                                                        <option value="square_feet"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'square_feet' ? 'selected' : '' }}>
                                                            Square Feet</option>
                                                        <option value="bigha"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'bigha' ? 'selected' : '' }}>
                                                            Bigha</option>
                                                        <option value="acre"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'acre' ? 'selected' : '' }}>
                                                            Acre</option>
                                                        <option value="hectare"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'hectare' ? 'selected' : '' }}>
                                                            Hectare</option>
                                                        <option value="kanal"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'kanal' ? 'selected' : '' }}>
                                                            Kanal</option>
                                                        <option value="marla"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'marla' ? 'selected' : '' }}>
                                                            Marla</option>
                                                        <option value="gaj"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'gaj' ? 'selected' : '' }}>
                                                            Gaj</option>
                                                        <option value="yard"
                                                            {{ old('extra_info_area_size_type', $hotel->extra_info_area_size_type ?? '') == 'yard' ? 'selected' : '' }}>
                                                            Yard</option>
                                                    </select>
                                                    @error('extra_info_area_size_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Number of Open Sides</label>
                                                    <select
                                                        class="form-control @error('num_of_open_sides') is-invalid @enderror"
                                                        name="num_of_open_sides">
                                                        <option value="">Select Number of Open Sides</option>
                                                        @for ($i = 1; $i <= 20; $i++)
                                                            <option value="{{ $i }}"
                                                                {{ old('num_of_open_sides', $hotel->num_of_open_sides ?? '') == $i ? 'selected' : '' }}>
                                                                {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    @error('num_of_open_sides')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Map Link</label>
                                                    <input
                                                        class="form-control @error('hotel_map_link') is-invalid @enderror"
                                                        type="text" name="hotel_map_link" placeholder="Enter Map Link"
                                                        value="{{ old('hotel_map_link', $hotel->hotel_map_link ?? '') }}" />
                                                    @error('hotel_map_link')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Add Facilities</h2>
                                            <div class="row">
                                                @foreach ($get_facilities as $faci)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <input class="@error('facilities') is-invalid @enderror"
                                                                    type="checkbox" name="facilities[]"
                                                                    value="{{ $faci->id }}"
                                                                    id="checkfac{{ $faci->id }}"
                                                                    onchange="removeClasscheck('{{ $faci->id }}')"
                                                                    {{ $faci->selected == 1 ? 'checked' : '' }} />
                                                                <label class="form-label"
                                                                    for="checkfac{{ $faci->id }}">{{ $loop->iteration }}.</label>
                                                                <label class="form-label"
                                                                    for="checkfac{{ $faci->id }}">{{ $faci->title }}</label>
                                                                @error('facilities')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                                <input
                                                                    class="form-control @error('number') is-invalid @enderror checkclass{{ $faci->id }} {{ $faci->selected != 1 ? 'd-none' : '' }}"
                                                                    type="number" name="number[]"
                                                                    value="{{ $faci->selected == 1 ? $faci->value : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h2>Add Amenities</h2>
                                            <div class="row">
                                                @foreach ($get_amenities as $ament)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <input class="@error('amenities') is-invalid @enderror"
                                                                    type="checkbox" name="amenities[]"
                                                                    value="{{ $ament->id }}"
                                                                    id="checkament{{ $ament->id }}"
                                                                    {{ $ament->selected == 1 ? 'checked' : '' }} />
                                                                <label class="form-label"
                                                                    for="checkament{{ $ament->id }}">{{ $loop->iteration }}.</label>
                                                                <label class="form-label"
                                                                    for="checkament{{ $ament->id }}">{{ $ament->title }}</label>
                                                                @error('amenities')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
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
    </div>

@endsection
<script>
    function removeClasscheck(id) {
        let create_class = "checkclass" + id;
        let create_id = "checkfac" + id;
        if ($("#" + create_id).prop('checked')) { // Check if the checkbox is checked
            $("." + create_class).removeClass("d-none");
        } else {
            $("." + create_class).addClass("d-none");
        }
    }

    function Deletesubimage(id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('delete.image') }}",
            type: 'POST',
            data: {
                _token: csrfToken,
                id: id,
            },
            success: function(response) {
                if (response == 1) {
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
    function AddProperty() {
        let get_category_id = $("#category_id").val()
        if (get_category_id == 1) {
            const url = "{{ route('book.property.create') }}?id=" + get_category_id + "";
            window.location.href = url; // Redirect to the generated URL
        }
    }
</script>
