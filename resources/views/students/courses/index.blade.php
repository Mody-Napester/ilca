<div class="modal fade" id="courses-modal" tabindex="-1" role="dialog" aria-labelledby="coursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabelText">{!! $title !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="" id="" style="background-color: #eeeeee;padding: 10px;margin-bottom: 10px;">
                    <form method="post" action="{{ route('students.courses.store', [$student->uuid]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="courses">Course</label>
                                    <select id="course" class="select2 form-control{{ $errors->has('courses') ? ' is-invalid' : '' }}" name="course">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->uuid }}">{{ $course->title }} - {{ $course->date_from }} - {{ $course->location->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('courses'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('courses') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="price">Price</label>
                                    <select id="price" class="select2 form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price">
                                        @foreach($prices as $price)
                                                <option value="{{ $price->uuid }}">{{ $price->price }} - {{ $price->currency->code }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="sales">Sales</label>
                                    <select id="sales" class="select2 form-control{{ $errors->has('sales') ? ' is-invalid' : '' }}" name="sales">
                                        <option value="0">Regular No Sales</option>
                                        @foreach($sales as $user)
                                            <option @if($user->uuid == old('sales')) selected @endif value="{{ $user->uuid }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('sales'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sales') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="attendance_type">Attendance type</label>
                                    <select id="attendance_type" class="select2 form-control{{ $errors->has('attendance_type') ? ' is-invalid' : '' }}" name="attendance_type">
                                        <option value="online">Online</option>
                                        <option value="offline">Attend in place</option>
                                    </select>

                                    @if ($errors->has('attendance_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('attendance_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="joined_at">Joined at</label>
                                    <input type="date" name="joined_at" id="joined_at" class="form-control{{ $errors->has('joined_at') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('joined_at'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('joined_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="fa fa-fw fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="" id="">
                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Course</th>
                            <th>Price</th>
                            <th>By Sales</th>
                            <th>Attendance type</th>
                            <th>Joined at</th>
                            <th>Created at</th>
                            <th>Control</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($studentCourses as $studentCourse)
                            <tr>
                                <td>{{  \App\Course::getBy('id', $studentCourse->course_id )->title }}</td>
                                <td>{{ \App\CoursePrice::getBy('id', $studentCourse->course_price_id)->price }}</td>
                                <td>{{ ($studentCourse->sales_id != null)? \App\User::getBy('id', $studentCourse->sales_id)->name : '-' }}</td>
                                <td>{{ ($studentCourse->attendance_type == 'offline')? 'Attend in place' : 'Online' }}</td>
                                <td>{{ $studentCourse->joined_at }}</td>
                                <td>{{ $studentCourse->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if (\App\User::hasAuthority('edit.students'))
                                            <a href="{{ route('students.courses.edit', [$studentCourse->id]) }}"
                                               class="update-course-modal btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('students.courses.destroy', [$studentCourse->id]) }}"
                                           class="confirm-delete btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
