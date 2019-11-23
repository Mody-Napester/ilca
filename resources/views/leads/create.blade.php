<form method="post" action="{{ route('leads.store') }}" enctype="multipart/form-data">
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
                <label class="" for="email">Email</label>
                <input type="email" id="email" autocomplete="off" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus/>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
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
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                Submit
            </button>
        </div>
    </div>
</form>