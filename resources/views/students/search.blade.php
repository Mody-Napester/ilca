<div class="row">
    <div class="col-md-6">
        <h3>Students</h3>
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
                        <select name="sales" id="sales" class="select2 form-control">
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
    </div>
    <div class="col-md-6" style="border-left: 1px solid #cccccc">
        <h3>Payments</h3>
        <form method="get" action="{{ route('students.search.payment') }}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="courses">Course</label>
                        <select name="courses" id="courses" class="select2 form-control">
                            <option selected value="all">All</option>
                            @foreach($courses as $course)
                                <option @if(isset($_GET['courses']) && $_GET['courses'] == $course->id) selected @endif value="{{ $course->id }}">{{ $course->title }} - {{ $course->date_from }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="payment">Payment</label>
                        <select name="payment" id="payment" class="select2 form-control">
                            <option selected value="choose">Choose</option>
                            <option value="1">Completed</option>
                            <option value="2">Remained</option>
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
    </div>
</div>
