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
                                                <option value="{{ $price->uuid }}">{{ $price->price }} - {{ $price->currency->name }}</option>
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
                                <td>{{ $studentCourse->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if (\App\User::hasAuthority('edit.students'))
                                            <a href="{{ route('students.edit', [$student->uuid]) }}"
                                               class="update-modal btn btn-sm btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif

                                        @if (\App\User::hasAuthority('delete.students'))
                                            <a href="{{ route('students.destroy', [$student->uuid]) }}"
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->