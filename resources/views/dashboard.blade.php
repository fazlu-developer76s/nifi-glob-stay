@extends('layouts/app')
@section('content')
@inject('helper', 'App\Helpers\Global_helper')


<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
<div id="content" class="app-content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ol class="breadcrumb float-xl-end">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item active">Welcome To Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <a href="#">
                <div class="card">
                    <div class="card-body no-padding" style="height:180px">
                        <div class="alert alert-callout  no-margin text-center">
                            <strong class="text-xl" style="font-size: 30px;"> Properties
                                <?php //$reqdata['COUNT(id)'];
                                ?></strong><hr>
                                <div class="row card_div">
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-success" style="font-size: 20px;">Approved </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Propertylist('1'); }} </span>
                                    </div>
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-warning" style="font-size: 20px;">Pending </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Propertylist('2'); }} </span>
                                    </div>
                                    <div class="col-md-4" >
                                        <span class="opacity-90 text-danger" style="font-size: 20px;">Rejected </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Propertylist('3'); }} </span>
                                    </div>
                                
                                </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#">
                <div class="card">
                    <div class="card-body no-padding" style="height:180px">
                        <div class="alert alert-callout  no-margin text-center">
                            <strong class="text-xl" style="font-size: 30px;"> Sellers
                                <?php //$reqdata['COUNT(id)'];
                                ?></strong><hr>
                                <div class="row card_div">
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-success" style="font-size: 20px;">Approved </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Sellers('1'); }} </span>
                                    </div>
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-warning" style="font-size: 20px;">Pending </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Sellers('2'); }} </span>
                                    </div>
                                    <div class="col-md-4" >
                                        <span class="opacity-90 text-danger" style="font-size: 20px;">Rejected </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Sellers('3'); }} </span>
                                    </div>
                                
                                </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="#">
                <div class="card">
                    <div class="card-body no-padding" style="height:180px">
                        <div class="alert alert-callout  no-margin text-center">
                            <strong class="text-xl" style="font-size: 30px;"> Enquires
                                <?php //$reqdata['COUNT(id)'];
                                ?></strong><hr>
                                <div class="row card_div">
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-success" style="font-size: 20px;">Contact </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Enquiry('1'); }} </span>
                                    </div>
                                    <div class="col-md-4" style="border-right:2px solid black;">
                                        <span class="opacity-90 text-warning" style="font-size: 20px;">Property  </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Enquiry('2'); }} </span>
                                    </div>
                                    <div class="col-md-4" >
                                        <span class="opacity-90 text-secondary" style="font-size: 20px;">Other </span>
                                        <br>
                                        <span class="opacity-90"  style="font-size: 20px;" >{{ $helper->Enquiry('3'); }} </span>
                                    </div>
                                
                                </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        

       <div class="row">
            @if($helper->getTablesCount())
                @foreach($helper->getTablesCount() as $data) 
                    <div class="col-lg-3">
                        <a href="#">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-success no-margin">
                                        <!-- Dynamic Content -->
                                        <span class="opacity-100">{{ str_replace('_',' ',$data['name'])  }}</span><br>
                                        <strong class="text-xl">{{ $data['count'] }}</strong>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</div>
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
    data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
</div>
@endsection
