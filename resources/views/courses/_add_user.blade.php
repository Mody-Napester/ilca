<form method="post" action="{{ route('courses.student.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="course_uuid" value="{{ $course->uuid }}">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="students">Students</label>
                <select id="students" multiple class="select2 form-control{{ $errors->has('students') ? ' is-invalid' : '' }}" name="students[]">
                    @foreach($students as $student)
                        <option @if(in_array($student->id, $course->students()->pluck('student_id')->toArray())) selected disabled @endif value="{{ $student->uuid }}">{{ $student->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('students'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('students') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-fw fa-save"></i> Add to course
            </button>
        </div>
    </div>
</form>