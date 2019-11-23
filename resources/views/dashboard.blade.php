@extends('_layouts.dashboard')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings</button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Dropdown One</a>
                    <a class="dropdown-item" href="#">Dropdown Two</a>
                    <a class="dropdown-item" href="#">Dropdown Three</a>
                    <a class="dropdown-item" href="#">Dropdown Four</a>
                </div>
            </div>

            <h4 class="page-title">Dashboard 2</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Ubold</a></li>
                <li class="breadcrumb-item active">Dashboard 2</li>
            </ol>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-attach-money text-primary"></i>
                <h2 class="m-0 text-dark counter font-600">50568</h2>
                <div class="text-muted m-t-5">Total Revenue</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-add-shopping-cart text-pink"></i>
                <h2 class="m-0 text-dark counter font-600">1256</h2>
                <div class="text-muted m-t-5">Sales</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-store-mall-directory text-info"></i>
                <h2 class="m-0 text-dark counter font-600">18</h2>
                <div class="text-muted m-t-5">Stores</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-custom"></i>
                <h2 class="m-0 text-dark counter font-600">8564</h2>
                <div class="text-muted m-t-5">Users</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-info">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120" data-height="45">5,3,9,6,5,9,7,3,5,2,9,7,2,1</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-custom">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-pie" data-colors="#5fbeaa,#ebeff2" data-width="50" data-height="45">1/5</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-danger">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-donut" data-colors="#f05050,#ebeff2" data-width="50" data-height="45">1/5</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection