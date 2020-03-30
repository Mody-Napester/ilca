<form method="post" action="{{ route('courses.student.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="course_uuid" value="{{ $course->uuid }}">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="students">Students</label>
                <select id="students" class="select2 form-control{{ $errors->has('students') ? ' is-invalid' : '' }}" name="students" required>
                    <option selected disabled>Choose</option>
                    @foreach($students as $student)
                        <option @if(in_array($student->id, $course->students()->pluck('student_id')->toArray())) disabled @endif value="{{ $student->uuid }}">{{ $student->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('students'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('students') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-12">
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

        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="sales">By Sales</label>
                <select id="sales" class="select2 form-control{{ $errors->has('sales') ? ' is-invalid' : '' }}" name="sales" >
                    <option value="">Regular No Sales</option>
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
                <i class="fa fa-fw fa-save"></i> Add to course
            </button>
        </div>
    </div>
</form>