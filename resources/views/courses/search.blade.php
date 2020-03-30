<form method="get" action="{{ route('courses.index') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="title">Title</label>
                <input id="title" type="text" autocomplete="off" class="form-control" name="title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="location">Location</label>
                <input id="location" type="text" autocomplete="off" class="form-control" name="location" value="{{ old('location') }}">
            </div>
        </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="price_egp">Price EGP</label>--}}
                {{--<input id="price_egp" type="text" autocomplete="off" class="form-control" name="price_egp" value="{{ old('price_egp') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label class="" for="price_usd">Price USD</label>--}}
                {{--<input id="price_usd" type="text" autocomplete="off" class="form-control" name="price_usd" value="{{ old('price_usd') }}">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_from">Date from</label>
                <input id="date_from" type="date" autocomplete="off" class="form-control" name="date_from" value="{{ old('date_from') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_to">Date to</label>
                <input id="date_to" type="date" autocomplete="off" class="form-control" name="date_to" value="{{ old('date_to') }}">
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="fa fa-fw fa-search"></i> Search
            </button>
        </div>
    </div>
</form>