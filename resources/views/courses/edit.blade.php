<form method="post" action="{{ route('courses.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="title">Title</label>
                <input id="title" type="text" autocomplete="off" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $resource->title }}" required>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="is_active">Is Active</label>
                <select id="is_active" class="select2 form-control{{ $errors->has('is_active') ? ' is-invalid' : '' }}" name="is_active" >
                     <option @if($resource->is_active == 1) selected @endif value="1">Yes</option>
                     <option @if($resource->is_active == 0) selected @endif value="0">No</option>
                </select>

                @if ($errors->has('is_active'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('is_active') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="price_egp">Price EGP</label>--}}
                {{--<input id="price_egp" type="text" autocomplete="off" class="form-control{{ $errors->has('price_egp') ? ' is-invalid' : '' }}" name="price_egp" value="{{ $resource->price_egp }}" required>--}}

                {{--@if ($errors->has('price_egp'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('price_egp') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="price_usd">Price USD</label>--}}
                {{--<input id="price_usd" type="text" autocomplete="off" class="form-control{{ $errors->has('price_usd') ? ' is-invalid' : '' }}" name="price_usd" value="{{ $resource->price_usd }}" required>--}}

                {{--@if ($errors->has('price_usd'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('price_usd') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_from">Date from</label>
                <input id="date_from" type="date" autocomplete="off" class="form-control{{ $errors->has('date_from') ? ' is-invalid' : '' }}" name="date_from" value="{{ $resource->date_from }}" required>

                @if ($errors->has('date_from'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date_from') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_to">Date to</label>
                <input id="date_to" type="date" autocomplete="off" class="form-control{{ $errors->has('date_to') ? ' is-invalid' : '' }}" name="date_to" value="{{ $resource->date_to }}" required>

                @if ($errors->has('date_to'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date_to') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="location">Location</label>
                <select id="location" class="select2 form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" >
                    @foreach($locations as $location)
                        <option @if($resource->location_id == $location->id) selected @endif value="{{ $location->uuid }}">{{ $location->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('location'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="trainers">Trainers</label>
                <select id="trainers" multiple class="select2 form-control{{ $errors->has('trainers') ? ' is-invalid' : '' }}" name="trainers[]" >
                    @foreach($trainers as $trainer)
                        <option @if(in_array($trainer->id, $resource->trainers()->pluck('trainer_id')->toArray())) selected @endif value="{{ $trainer->uuid }}">{{ $trainer->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('trainers'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('trainers') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="prices">Prices</label>
                <select id="prices" multiple class="select2 form-control{{ $errors->has('prices') ? ' is-invalid' : '' }}" name="prices[]" >
                    @foreach($prices as $price)
                        <option @if(in_array($price->id, $resource->prices()->pluck('course_price_id')->toArray())) selected @endif value="{{ $price->uuid }}">{{ $price->price }} - {{ $price->currency->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('prices'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('prices') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="certificates">Certificates</label>
                <select id="certificates" multiple class="select2 form-control{{ $errors->has('certificates') ? ' is-invalid' : '' }}" name="certificates[]" >
                    @foreach($certificates as $certificate)
                        <option @if(in_array($certificate->id, $resource->certificates()->pluck('certificate_id')->toArray())) selected @endif value="{{ $certificate->uuid }}">{{ $certificate->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('certificates'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('certificates') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="details">Details</label>
                <textarea id="details" autocomplete="off" class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" required>{{ $resource->details }}</textarea>
                @if ($errors->has('details'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('details') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="comments">Comments</label>
                <textarea id="comments" autocomplete="off" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" required>{{ $resource->comments }}</textarea>
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