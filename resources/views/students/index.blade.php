@extends('_layouts.dashboard')

@section('title') Students @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#createNew" aria-expanded="false" aria-controls="createNew">
                    Add New Student <i class="fa fa-fw fa-plus"></i>
                </button>
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Students</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Students</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>

    <div class="row collapse" id="createNew">
        <div class="col-lg-12">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                {{--<li class="nav-item">--}}
                    {{--<a href="#searchResource" data-toggle="tab" aria-expanded="false" class="nav-link active">Search and filter</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a href="#createResource" data-toggle="tab" aria-expanded="true" class="nav-link active">Create new</a>
                </li>
            </ul>
            <div class="tab-content">
                {{--<div class="tab-pane active" id="searchResource">--}}
                    {{--@include('students.search')--}}
                {{--</div>--}}
                <div class="tab-pane active" id="createResource">
                    @include('students.create')
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>


    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Students</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Nationality</th>
                            <th>Email</th>
                            {{--<th>Address</th>--}}
                            {{--<th>Comments</th>--}}
                            <th>Courses</th>
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Control</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->phone }}</td>
                            <td>{{ ($nat = $resource->student_nationality)? $nat->nationality_en . '/' . $nat->nationality_ar : '-' }}</td>
                            <td>{{ $resource->email }}</td>
                            {{--<td>{{ $resource->address }}</td>--}}
                            {{--<td>{{ $resource->comments }}</td>--}}
                            <td>
                                @foreach($resource->courses as $course)
                                <span class="badge badge-danger">{{ $course->title }}</span>
                                @endforeach
                            </td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ ($resource->updatedBy)? $resource->updatedBy->name : '-' }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                <div class="btn-group">
                                    @if (\App\User::hasAuthority('edit.students'))
                                        <a href="{{ route('students.courses.index', [$resource->uuid]) }}" class="courses-modal btn btn-sm btn-warning"
                                           data-toggle="tooltip" data-placement="top" title="" data-original-title="Courses">
                                           <i class="fa fa-clone"></i>
                                        </a>
                                    @endif
                                    @if (\App\User::hasAuthority('edit.students'))
                                        <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Certificates">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-certificate"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                @foreach($resource->courses as $course)
                                                <li><a href="{{ route('courses.certificates.show', [$course->uuid, $resource->uuid]) }}" class="show-certificates dropdown-item">{{ $course->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (\App\User::hasAuthority('edit.students'))
                                        <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Payments">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-dollar"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                @foreach($resource->courses as $course)
                                                    <li><a href="{{ route('courses.payments.show', [$course->uuid, $resource->uuid]) }}" class="show-payments dropdown-item">{{ $course->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (\App\User::hasAuthority('edit.students'))
                                        <div class="dropdown" data-toggle="tooltip" data-placement="top" title="" data-original-title="Research">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-sticky-note-o"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                @foreach($resource->courses as $course)
                                                    <li><a href="{{ route('courses.research.show', [$course->uuid, $resource->uuid]) }}" class="show-research dropdown-item">{{ $course->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (\App\User::hasAuthority('edit.students'))
                                        <a href="{{ route('students.edit', [$resource->uuid]) }}"
                                           class="update-modal btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif

                                    @if (\App\User::hasAuthority('delete.students'))
                                        <a href="{{ route('students.destroy', [$resource->uuid]) }}"
                                           class="confirm-delete btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        var tableDTUsers = $('#datatable-history-buttons').DataTable({
            lengthChange: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection