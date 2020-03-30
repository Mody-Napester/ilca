<table class="table table-bordered table-sm mb-3">
    <tr>
        <td class="text-primary">Course</td>
        <td>{{ $course->title }}</td>
        <td class="text-primary">Price</td>
        <td>{{ $price->price }} {{ ($price->currency)? $price->currency->code : '-' }}</td>
    </tr>
    <tr>
        <td class="text-primary">Paid</td>
        <td>{{ $sumPayments }} {{ ($price->currency)? $price->currency->code : '-' }}</td>
        <td class="text-primary">Remained</td>
        <td>{{ $price->price - $sumPayments }} {{ ($price->currency)? $price->currency->code : '-' }}</td>
    </tr>
</table>

<div class="" id="" style="background-color: #eeeeee;padding: 10px;margin-bottom: 10px;">
    <form method="post" action="{{ route('courses.payments.store', [$course->uuid, $student->uuid]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>

                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="amount">Amount</label>
                    <input type="number" step="0.01" max="{{ $price->price - $sumPayments }}" name="amount" id="amount" class="form-control" required>

                    @if ($errors->has('amount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('amount') }}</strong>
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
</div>

<div>
    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Received Date</th>
            <th>Received by</th>
            <th>Created at</th>
            <th>Amount</th>
        </tr>
        </thead>

        <tbody>
        @foreach($allPayments as $key => $payment)
            <tr>
                <td>{{ $payment->date }}</td>
                <td>{{ \App\User::where('id', $payment->created_by)->first()->name }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>{{ $payment->amount }}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <th class="text-danger text-center" colspan="3">Total</th>
            <th class="text-danger">{{ $sumPayments }}</th>
        </tr>
        </tfoot>
    </table>
</div>