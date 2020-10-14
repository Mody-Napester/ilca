<form method="post" action="{{ route('students.courses.update', [$studentCourse->id]) }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="courses">Course</label>
                <select id="course" class="select2 form-control" name="course">
                    @foreach($courses as $course)
                        <option @if($course->id == $studentCourse->course_id) selected @endif value="{{ $course->uuid }}">{{ $course->title }} - {{ $course->date_from }} - {{ $course->location->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="price">Price</label>
                <select id="price" class="select2 form-control" name="price">
                    @foreach($prices as $price)
                        <option @if($price->id == $studentCourse->course_price_id) selected @endif value="{{ $price->uuid }}">{{ $price->price }} - {{ $price->currency->code }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="sales">Sales</label>
                <select id="sales" class="select2 form-contro" name="sales">
                    <option value="0">Regular No Sales</option>
                    @foreach($sales as $user)
                        <option @if($user->id == $studentCourse->sales_id) selected @endif value="{{ $user->uuid }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="attendance_type">Attendance type</label>
                <select id="attendance_type" class="select2 form-control" name="attendance_type">
                    <option @if($studentCourse->attendance_type == 'online') selected @endif value="online">Online</option>
                    <option @if($studentCourse->attendance_type == 'offline') selected @endif value="offline">Offline</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="joined_at">Joined at</label>
                <input type="date" name="joined_at" id="joined_at" value="{{ $studentCourse->joined_at }}" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="fa fa-fw fa-save"></i> Update
            </button>
        </div>
    </div>
</form>
