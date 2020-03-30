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
        <p><b>Number of students :</b> {{ $course->students->count() }}</p>
    </div>
    <div class="col-sm-6">
        {{--<p><b>Price egp :</b> {{ $course->price_egp }}</p>--}}
        {{--<p><b>Price usd :</b> {{ $course->price_usd }}</p>--}}
        <p><b>Date from :</b> {{ $course->date_from }}</p>
        <p><b>Date to :</b> {{ $course->date_to }}</p>
        <p><b>Trainers :</b>
            @foreach($course->trainers as $trainer)
                <span class="label label-danger" style="margin-right: 5px;"> {{ $trainer->name }} </span>
            @endforeach
        </p>
        <p><b>Prices :</b>
            @foreach($course->prices as $price)
                <span class="label label-primary" style="margin-right: 5px;"> {{ $price->price }} - {{ $price->currency->name }} </span>
            @endforeach
        </p>
        <p><b>Certificates :</b>
            @foreach($course->certificates as $certificate)
                <span class="label label-success" style="margin-right: 5px;"> {{ $certificate->name }} </span>
            @endforeach
        </p>
    </div>
</div>


