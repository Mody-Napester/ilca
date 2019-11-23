@extends('_layouts.dashboard')

@section('title') Payments @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Payments</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Activity</a></li>
                <li class="breadcrumb-item"><a href="#">Payments</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card-box">
                @include('activities.payments.activity')
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                @include('activities.payments.create')
            </div>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Payments</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Effect</th>
                            <th>Created by</th>
                            <th>Created at</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($activity->payments as $payment)
                        <tr>
                            <td>{{ ($payment->activityPaymentStatus)? $payment->activityPaymentStatus->name : '-' }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->createdBy->name }}</td>
                            <td>{{ ($payment->effect == 1)? 'Increased' : 'Decreased' }}</td>
                            <td>{{ $payment->created_at }}</td>
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
            // buttons: [
            //     {
            //         extend: 'copyHtml5',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
            //         }
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ,14, 15, 16]
            //         }
            //     }
            // ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection