@extends('_layouts.dashboard')

@section('title') Course Prices @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Course Prices</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Course Prices</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#createResource" data-toggle="tab" aria-expanded="false" class="nav-link active">Create new</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="createResource">
                    @include('course_prices.create')
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>


    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Course Prices</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Price</th>
                            <th>Currency</th>
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
                            <td>{{ $resource->price }}</td>
                            <td>{{ $resource->currency->name }}</td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ ($resource->updatedBy)? $resource->updatedBy->name : '-' }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                @if (\App\User::hasAuthority('edit.course_prices'))
                                <a href="{{ route('course_prices.edit', [$resource->uuid]) }}"
                                   class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endif
                                @if (\App\User::hasAuthority('delete.course_prices'))
                                <a href="{{ route('course_prices.destroy', [$resource->uuid]) }}"
                                   class="confirm-delete btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                                @endif
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection