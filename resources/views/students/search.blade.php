<form method="get" action="{{ route('students.index') }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="name">Name</label>
                <input id="name" type="text" autocomplete="off" class="form-control" name="name" value="{{ (isset($_GET['name']))? $_GET['name'] : '' }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="phone">Phone</label>
                <input id="phone" type="text" autocomplete="off" class="form-control" name="phone" value="{{ (isset($_GET['phone']))? $_GET['phone'] : '' }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="sales">Sales</label>
                <select name="sales" id="sales" class="form-control">
                    <option selected value="choose">Choose</option>
                    @foreach($sales as $sale)
                        <option @if(isset($_GET['sales']) && $_GET['sales'] == $sale->id) selected @endif value="{{ $sale->id }}">{{ $sale->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-default waves-effect waves-light">
                <i class="fa fa-fw fa-save"></i> Search
            </button>
        </div>
    </div>
</form>
