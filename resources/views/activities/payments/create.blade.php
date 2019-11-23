<form method="post" action="{{ route('activity-payments.store', [$activity->uuid]) }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="activity_payment_status">Payment status</label>
                <select id="activity_payment_status" class="select2 form-control{{ $errors->has('activity_payment_status') ? ' is-invalid' : '' }}" name="activity_payment_status">
                    @foreach($payment_statuses as $payment_status)
                        <option value="{{ $payment_status->id }}">{{ $payment_status->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('activity_payment_status'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('activity_payment_status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="amount">Amount</label>
                <input id="amount" type="text" autocomplete="off" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>

                @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="effect">Effect</label>
                <select id="effect" class="select2 form-control{{ $errors->has('effect') ? ' is-invalid' : '' }}" name="effect">
                    <option value="1">Increase</option>
                    <option value="0">Decrease</option>
                </select>

                @if ($errors->has('effect'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('effect') }}</strong>
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