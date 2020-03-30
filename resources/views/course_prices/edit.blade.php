<form method="post" action="{{ route('course_prices.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="price">Price</label>
                <input id="price" type="text" autocomplete="off" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $resource->price }}" required>

                @if ($errors->has('price'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="currency">Currency</label>
                <select id="currency" class="select2 form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" >
                    @foreach($currencies as $currency)
                        <option @if($currency->id == $resource->currency_id) selected @endif value="{{ $currency->id }}">{{ $currency->code }} - {{ $currency->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('currency'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('currency') }}</strong>
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