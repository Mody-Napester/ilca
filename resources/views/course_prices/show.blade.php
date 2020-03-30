@extends('_layouts.dashboard')

@section('title') Course @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Course</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Course</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                @include('courses._details')
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                @include('courses._add_user')
            </div>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Course</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Certificates</th>
                            <th>Payment</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($course->students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>
                                <a href="{{ route('courses.certificates.show', [$course->uuid, $student->uuid]) }}"
                                   class="show-certificates btn btn-sm btn-success">
                                    Show or edit
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('courses.payments', [$course->uuid, $student->uuid]) }}"
                                   class="show-payments btn btn-sm btn-danger">
                                    Show or edit
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
        // General Update
        $('body').on('click', '.show-certificates', function (event) {
            event.preventDefault();
            var url, targetModal;

            url = $(this).attr('href');
            targetModal = $('#show-certificates');

            // Get contents
            $.ajax({
                method:'GET',
                url:url,
                beforeSend:function () {
                    addLoader();
                },
                success:function (data) {
                    targetModal.find('#certiModalLabel').text(data.title);
                    targetModal.find('.modal-body').html(data.view);
                    // Select2
                    $(".select2").select2();
                    removeLoarder();
                },
                error:function () {

                }
            });

            // Show modal
            targetModal.modal();
        });

        var tableDTUsers = $('#datatable-history-buttons').DataTable({
            lengthChange: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection