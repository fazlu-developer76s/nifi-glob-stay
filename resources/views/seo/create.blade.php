@extends('layouts/app')
@section('content')
@if(isset($get_seo))
@php $form_action = "seo.update" @endphp
@else
@php $form_action = "seo.create" @endphp
@endif
    <div class="container-fluid">
        <div id="content" class="app-content">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:;"> Seo</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Create  Seo</li>
                    </ol>
                    <h1 class="page-header mb-0"> Seo</h1>
                </div>
            </div>
            <!-- Row for equal division -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 mb-4">
                        <div class="card-header h6 mb-0 bg-none p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-shield fa-lg fa-fw text-dark text-opacity-50 me-1"></i>
                                Add  Seo
                            </div>
                        </div>
                        <form action="{{ route($form_action) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ (isset($get_seo)) ? $get_seo->id : '' ; }}" name="hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Page Url</label>
                                            <input class="form-control @error('url') is-invalid @enderror" type="text" name="url" placeholder="Enter Title" value="@if(empty($get_seo)) {{ old('url') }} @else {{ (isset($get_seo)) ? $get_seo->url : '' ; }} @endif" />
                                            @error('url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input class="form-control @error('meta_title') is-invalid @enderror" type="text" name="meta_title" placeholder="Enter Title" value="@if(empty($get_seo)) {{ old('meta_title') }} @else {{ (isset($get_seo)) ? $get_seo->meta_title : '' ; }} @endif" />
                                            @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keyword</label>
                                            <input class="form-control @error('meta_keyword') is-invalid @enderror" type="text" name="meta_keyword" placeholder="Enter Title" value="@if(empty($get_seo)) {{ old('meta_keyword') }} @else {{ (isset($get_seo)) ? $get_seo->meta_keyword : '' ; }} @endif" />
                                            @error('meta_keyword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Robot</label>
                                            <input class="form-control @error('meta_robot') is-invalid @enderror" type="text" name="meta_robot" placeholder="Enter Title" value="@if(empty($get_seo)) {{ old('meta_robot') }} @else {{ (isset($get_seo)) ? $get_seo->meta_robot : '' ; }} @endif" />
                                            @error('meta_robot')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" type="text" name="meta_description" placeholder="Enter meta_description">@if(empty($get_seo)) {{ old('meta_description') }} @else {{ (isset($get_seo)) ? $get_seo->meta_description : '' ; }} @endif</textarea>
                                            @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Header Script</label>
                                            <textarea class="form-control @error('header_script') is-invalid @enderror" type="text" name="header_script" placeholder="Enter header_script">@if(empty($get_seo)) {{ old('header_script') }} @else {{ (isset($get_seo)) ? $get_seo->header_script : '' ; }} @endif</textarea>
                                            @error('header_script')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Footer Script</label>
                                            <textarea class="form-control @error('footer_script') is-invalid @enderror" type="text" name="footer_script" placeholder="Enter footer_script">@if(empty($get_seo)) {{ old('footer_script') }} @else {{ (isset($get_seo)) ? $get_seo->footer_script : '' ; }} @endif</textarea>
                                            @error('footer_script')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control custom-select-icon @error('status') is-invalid @enderror" name="status">
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }} {{ (isset($get_seo) && $get_seo->status == 1) ? 'selected' : '' ; }}>Active</option>
                                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }} {{ (isset($get_seo) && $get_seo->status == 2) ? 'selected' : '' ; }}>Inactive</option>
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
            </div>
        </div>
    </div>
@endsection
