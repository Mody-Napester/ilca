@extends('_layouts.dashboard')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-custom"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\User::count('*') }}</h2>
                <div class="text-muted m-t-5">Users</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-bookmark text-primary"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Certificate::count('*') }}</h2>
                <div class="text-muted m-t-5">Certificates</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-grade text-pink"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Course::count('*') }}</h2>
                <div class="text-muted m-t-5">Courses</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-group text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Student::count('*') }}</h2>
                <div class="text-muted m-t-5">Students</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-school text-primary"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Role::count('*') }}</h2>
                <div class="text-muted m-t-5">Roles</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-pin-drop text-primary"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Location::count('*') }}</h2>
                <div class="text-muted m-t-5">Locations</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-beenhere text-pink"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Trainer::count('*') }}</h2>
                <div class="text-muted m-t-5">Trainers</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-layers text-info"></i>
                <h2 class="m-0 text-dark counter font-600">{{ \App\Lead::count('*') }}</h2>
                <div class="text-muted m-t-5">Leads</div>
            </div>
        </div>

    </div>

@endsection