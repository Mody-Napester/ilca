<h4 class="m-t-0 header-title">Course "{{ $course->title }}"</h4>
<hr>

<div class="row">
    <div class="col-sm-6">
        <p><b>Title :</b> {{ $course->title }}</p>
        <p><b>Details :</b> {{ $course->details }}</p>
        <p><b>Location :</b> {{ ($course->location)? $course->location->name : '-' }}</p>
        <p><b>Comments :</b> {{ $course->comments }}</p>
        <p><b>Created by :</b> {{ $course->createdBy->name }}</p>
        <p><b>Updated by :</b> {{ ($course->updatedBy)? $course->updatedBy->name : '-' }}</p>
    </div>
    <div class="col-sm-6">
        <p><b>Price egp :</b> {{ $course->price_egp }}</p>
        <p><b>Price usd :</b> {{ $course->price_usd }}</p>
        <p><b>Date from :</b> {{ $course->date_from }}</p>
        <p><b>Date to :</b> {{ $course->date_to }}</p>
        <p><b>Trainers :</b> @foreach($course->trainers as $trainer) {{ $trainer->name }},  @endforeach</p>
        <p><b>Number of students :</b> {{ $course->students->count() }}</p>
    </div>
</div>


