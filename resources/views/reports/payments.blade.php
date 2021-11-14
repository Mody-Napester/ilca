@extends('_layouts.dashboard')

@section('title') Payments Report @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show List <i class="fa fa-fw fa-arrow-down"></i></a>
                <a href="{{ route('reports.getPaymentsReport') }}?getall=yes" class="btn btn-primary waves-effect waves-light">Get All</a>
            </div>

            <h4 class="page-title">Payments Report</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Payments</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Search Student</h4>
                <p class="text-muted font-14 m-b-30">
                    Search for students.
                </p>

                <form method="get" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="name">Name</label>
                                <input id="name" type="text" autocomplete="off" class="form-control" name="name" value="{{ (isset($_GET['name']))? $_GET['name'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="phone">Phone</label>
                                <input id="phone" type="text" autocomplete="off" class="form-control" name="phone" value="{{ (isset($_GET['phone']))? $_GET['phone'] : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="email">Email</label>
                                <input id="email" type="email" autocomplete="off" class="form-control" name="email" value="{{ (isset($_GET['email']))? $_GET['email'] : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-default waves-effect waves-light">
                                <i class="fa fa-fw fa-save"></i> Search
                            </button>
                            <a href="{{ route('reports.getPaymentsReport') }}" class="btn btn-danger waves-effect waves-light">
                                <i class="fa fa-fw fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end row -->


    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Students</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table data-page-length='100' id="datatable-users-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Nationality</th>
                            <th>Email</th>
                            <th>Total Courses</th>
                            <th>Total Prices</th>
                            <th>Total Paid</th>
                            <th>Total Remain</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $counter = 1;
                        $Total_Courses_Counter = 0;
                        $Total_Prices_Counter = 0;
                        $Total_Paid_Counter = 0;
                        $Total_Remain_Counter = 0;
                    ?>
                    @foreach($students as $student)

                        <?php
                            $Total_Courses = 0;
                            $Total_Prices = 0;
                            $Total_Paid = 0;
                            $Total_Remain = 0;
                        ?>
                        @foreach($student->courses as $course)

                            <?php
                                $payments = \Illuminate\Support\Facades\DB::table('course_payment')
                                ->where('course_id', $course->id)
                                ->where('student_id', $student->id)
                                ->sum('amount');

                                $price = \App\CoursePrice::where('id', $course->pivot->course_price_id)->first();
                                if($price){
                                    $currency = \App\Currency::where('id', $price->currency_id)->first();
                                }else{
                                    $price = collect(new \App\CoursePrice());
                                    $currency = collect(new \App\Currency());
                                    $price->price = 0;
                                    $currency->code = 'EGP';
                                }

                                $Total_Courses = $Total_Courses + 1;
                                $Total_Prices = $Total_Prices + $price->price;
                                $Total_Paid = $Total_Paid + $payments;
                                $Total_Remain = $Total_Remain + ($price->price - $payments);
                            ?>

                        @endforeach

                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ ($nat = $student->student_nationality)? $nat->nationality_en . '/' . $nat->nationality_ar : '-' }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $Total_Courses }}</td>
                            <td>{{ $Total_Prices }}</td>
                            <td>{{ $Total_Paid }}</td>
                            <td>{{ $Total_Remain }}</td>
                        </tr>

                        <?php
                            $Total_Courses_Counter = $Total_Courses_Counter + $Total_Courses;
                            $Total_Prices_Counter = $Total_Prices_Counter + $Total_Prices;
                            $Total_Paid_Counter = $Total_Paid_Counter + $Total_Paid;
                            $Total_Remain_Counter = $Total_Remain_Counter + $Total_Remain;
                        ?>
                    @endforeach
                    </tbody>

                    <tfooter>
                        <tr>
                            <td colspan="6" class="text-right"><b>{{ $Total_Courses_Counter }}</b> Taken Courses</td>
                            <td><b>{{ $Total_Prices_Counter }}</b></td>
                            <td><b>{{ $Total_Paid_Counter }}</b></td>
                            <td><b>{{ $Total_Remain_Counter }}</b></td>
                        </tr>
                    </tfooter>
                </table>
            </div>

            @if($students instanceof \Illuminate\Pagination\LengthAwarePaginator )

                {{ $students->appends($_GET)->links() }}

            @endif
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
            <?php $counter = 8; ?>
        var arrNum = [
                @for($i = 0; $i <= $counter; $i++)
                {{ $i }}
                @if($i < $counter)
                ,
                @endif
                @endfor
            ];

        var tableDTUsers = $('#datatable-users-buttons').DataTable({
            lengthChange: false,
            "ordering": false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: arrNum
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: arrNum
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: arrNum
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: arrNum
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-users-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection
