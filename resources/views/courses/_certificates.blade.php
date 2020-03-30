<form method="post" action="{{ route('courses.certificates.store', [$course->uuid, $student->uuid]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Certificate</th>
            <th>Control</th>
            <th>Delivered</th>
            <th>By</th>
            <th>Created</th>
        </tr>
        </thead>

        <tbody>
        @foreach($course->certificates as $key => $certificate)
            <?php $csc = DB::table('course_student_certificate')
                ->where('course_id', $course->id)
                ->where('student_id', $student->id)
                ->where('certificate_id', $certificate->id)
                ->first(); ?>
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $certificate->name }}</td>
                <td>
                    @if($csc)
                        <i class="fa fa-fw fa-check"></i>
                    @else
                        <input type="checkbox" name="certificates[]" class="form-control" id="" value="{{ $certificate->uuid }}">
                    @endif
                </td>
                <td>
                    @if($csc)
                        {{ $csc->date }}
                    @else
                        <input type="date" name="dates[]" class="form-control">
                    @endif
                </td>
                <td>
                    @if($csc)
                        {{ \App\User::where('id', $csc->created_by)->first()->name }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($csc)
                        {{ $csc->created_at }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                Update
            </button>
        </div>
    </div>
</form>