<form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name">Name</label>
                <input id="name" type="text" autocomplete="off" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

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
                <input id="phone" type="text" autocomplete="off" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

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
                        <option @if($nationality->id == old('nationality')) selected @endif value="{{ $nationality->id }}">{{ $nationality->nationality_en }}/{{ $nationality->nationality_ar }}</option>
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
                <input type="email" id="email" autocomplete="off" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"/>

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
                <input id="address" type="text" autocomplete="off" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">

                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="sales">Sales</label>--}}
                {{--<select id="sales" class="select2 form-control{{ $errors->has('sales') ? ' is-invalid' : '' }}" name="sales" >--}}
                    {{--<option value="">Regular No Sales</option>--}}
                    {{--@foreach($sales as $user)--}}
                        {{--<option @if($user->uuid == old('sales')) selected @endif value="{{ $user->uuid }}">{{ $user->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}

                {{--@if ($errors->has('sales'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('sales') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="courses">Courses</label>--}}
                {{--<select id="courses" multiple class="select2 form-control{{ $errors->has('courses') ? ' is-invalid' : '' }}" name="courses[]" >--}}
                    {{--@foreach($courses as $course)--}}
                        {{--<option value="{{ $course->uuid }}">{{ $course->title }} - {{ $course->date_from }} - {{ $course->location->name }}</option>--}}
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
                <textarea id="comments" autocomplete="off" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments">{{ old('comments') }}</textarea>
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
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-fw fa-save"></i> Save
            </button>
        </div>
    </div>
</form>