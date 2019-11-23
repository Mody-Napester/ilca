<form method="get" action="{{ route('companies.index') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="name">Name</label>
                <input id="name" type="text" autocomplete="off" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="email">Email</label>
                <input type="email" id="email" autocomplete="off" class="form-control" name="email" value="{{ old('email') }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="phone">Phone</label>
                <input id="phone" type="text" autocomplete="off" class="form-control" name="phone" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="website">Website</label>
                <input id="website" type="text" autocomplete="off" class="form-control" name="website" value="{{ old('website') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="address">Address</label>
                <input id="address" type="text" autocomplete="off" class="form-control" name="address" value="{{ old('address') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="comments">Comments</label>
                <input id="comments" type="text" autocomplete="off" class="form-control" name="comments" value="{{ old('comments') }}">
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