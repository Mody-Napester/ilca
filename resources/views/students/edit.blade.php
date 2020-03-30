<form method="post" action="{{ route('students.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name">Name</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $resource->name }}" required>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="phone">Phone</label>
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $resource->phone }}" required>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="nationality">Nationality</label>
                <select class="select2 form-control{{ $errors->has('nationality') ? ' is-invalid' : '' }}" name="nationality" id="nationality" required>
                    @foreach($nationalities as $nationality)
                        <option @if($nationality->id == $resource->nationality) selected @endif value="{{ $nationality->id }}">{{ $nationality->nationality_en }}/{{ $nationality->nationality_ar }}</option>
                    @endforeach
                </select>

                @if ($errors->has('nationality'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nationality') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="email">Email</label>
                <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $resource->email }}"/>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="address">Address</label>
                <input id="address" type="text" autocomplete="off" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $resource->address }}">

                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="courses">Courses</label>--}}
                {{--<select id="courses" multiple class="select2 form-control{{ $errors->has('courses') ? ' is-invalid' : '' }}" name="courses[]" >--}}
                    {{--@foreach($courses as $course)--}}
                        {{--<option @if(in_array($course->id, $resource->courses()->pluck('course_id')->toArray())) selected @endif value="{{ $course->uuid }}">{{ $course->title }} - {{ $course->date_from }} - {{ $course->location->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}

                {{--@if ($errors->has('courses'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('courses') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="comments">Comments</label>
                <textarea id="comments" autocomplete="off" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments">{{ $resource->comments }}</textarea>
                @if ($errors->has('comments'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                Update
            </button>
        </div>
    </div>
</form>