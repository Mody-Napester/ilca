@extends('_layouts.dashboard')

@section('title') Activities @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Activities</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Activities</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>

    <div class="card-box">
        <h4 class="m-t-0 header-title">Create new Activity</h4>
        <p class="text-muted font-14 m-b-30">
            Create new resource from here.
        </p>

        @include('activities.create')
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Activities</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Client</th>
                            <th>task_name</th>
                            <th>task_type</th>
                            <th>num_of_words</th>
                            <th>num_of_papers</th>
                            <th>lang_from</th>
                            <th>lang_to</th>
                            <th>rate</th>
                            <th>project_manger_id</th>
                            <th>deadline</th>
                            <th>activity_status_id</th>
                            <th>comments</th>
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
                            <td>{{ $resource->client->name }}</td>
                            <td>{{ $resource->task_name }}</td>
                            <td>{{ $resource->task_type }}</td>
                            <td>{{ $resource->num_of_words }}</td>
                            <td>{{ $resource->num_of_papers }}</td>
                            <td>{{ ($resource->langFrom)? $resource->langFrom->name : '-' }}</td>
                            <td>{{ ($resource->langTo)? $resource->langTo->name : '-' }}</td>
                            <td>{{ $resource->rate }}</td>
                            <td>{{ ($resource->projectManager)? $resource->projectManager->name : '-' }}</td>
                            <td>{{ $resource->deadline }}</td>
                            <td>{{ ($resource->activityStatus)? $resource->activityStatus->name : '-' }}</td>
                            <td>{{ $resource->comments }}</td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ ($resource->updatedBy)? $resource->updatedBy->name : '-' }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                <a href="{{ route('activities.edit', [$resource->uuid]) }}"
                                   class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                                <a href="{{ route('activity-payments.show', [$resource->uuid]) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="fa fa-fw fa-dollar"></i>
                                </a>
                                <a href="{{ route('activities.destroy', [$resource->uuid]) }}"
                                   class="confirm-delete btn btn-sm btn-danger">
                                    <i class="fa fa-fw fa-times"></i>
                                </a>
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection