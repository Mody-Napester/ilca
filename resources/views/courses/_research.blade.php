<table class="table table-bordered table-sm mb-3">
    <tr>
        <td class="text-primary">For Course</td>
        <td>{{ $course->title }}</td>
    </tr>
</table>

<div class="" id="" style="background-color: #eeeeee;padding: 10px;margin-bottom: 10px;">
    <form method="post" action="{{ route('courses.research.store', [$course->uuid, $student->uuid]) }}" enctype="multipart/form-data">
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
                    <label class="" for="research">Research</label>
                    <input type="file" name="research" id="research" class="form-control" required>

                    @if ($errors->has('research'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('research') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group m-b-0">
            <div>
                <button type="submit" class="btn btn-success waves-effect waves-light">
                    Save
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
            <th>Research file</th>
        </tr>
        </thead>

        <tbody>
        @foreach($researches as $key => $research)
            <tr>
                <td>{{ $research->date }}</td>
                <td>{{ \App\User::where('id', $research->created_by)->first()->name }}</td>
                <td>{{ $research->created_at }}</td>
                <td>
                    <a download href="{{ url('assets/images/research/' . $research->research) }}">Download</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>