@extends('_layouts.dashboard')

@section('title') Students Report @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-warning waves-effect waves-light">Show List <i class="fa fa-fw fa-arrow-down"></i></a>
                <a href="{{ route('reports.getStudentsReport') }}?getall=yes" class="btn btn-primary waves-effect waves-light">Get All</a>
            </div>

            <h4 class="page-title">Students Report</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Students</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Search Student</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
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
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="" for="courses">Course</label>--}}
{{--                                <select name="courses" id="courses" class="select2 form-control">--}}
{{--                                    <option selected value="all">All</option>--}}
{{--                                    @foreach($courses as $course)--}}
{{--                                        <option @if(isset($_GET['courses']) && $_GET['courses'] == $course->id) selected @endif value="{{ $course->id }}">{{ $course->title }} - {{ $course->date_from }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-default waves-effect waves-light">
                                <i class="fa fa-fw fa-save"></i> Search
                            </button>
                            <a href="{{ route('reports.getStudentsReport') }}" class="btn btn-danger waves-effect waves-light">
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
                            <th>Course</th>
                            <th>Attendance</th>
                            <th>Price</th>
                            <th>Paid</th>
                            <th>Remain</th>
                            <th>Joined at</th>
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $counter = 1; ?>
                    @foreach($students as $student)
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
                            ?>
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ ($nat = $student->student_nationality)? $nat->nationality_en . '/' . $nat->nationality_ar : '-' }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ ($course->pivot->attendance_type == 'online')? 'online' : 'offline' }}</td>
                                <td>{{ $price->price . ' ' . $currency->code }}</td>
                                <td>{{ $payments }}</td>
                                <td>{{ $price->price - $payments }}</td>
                                <td>{{ $course->pivot->joined_at }}</td>
                                <td>{{ ($course->createdBy)? $course->createdBy->name : '-' }}</td>
                                <td>{{ ($course->updatedBy)? $course->updatedBy->name : '-' }}</td>
                                <td>{{ $course->created_at }}</td>
                                <td>{{ $course->updated_at }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
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
            <?php $counter = 14; ?>
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
