<h4 class="m-t-0 header-title">Activity "{{ $activity->task_name }}"</h4>
<hr>

<div class="row">
    <div class="col-sm-6">
        <p><b>Client :</b> {{ $activity->client->name }}</p>
        <p><b>Task type :</b> {{ $activity->task_type }}</p>
        <p><b>Rate :</b> {{ $activity->rate }}</p>
        <p><b>Project manger :</b> {{ ($activity->projectManager)? $activity->projectManager->name : '-' }}</p>
        <p><b>Num of words :</b> {{ $activity->num_of_words }}</p>
        <p><b>Num of papers :</b> {{ $activity->num_of_papers }}</p>
        <p><b>Deadline :</b> {{ $activity->deadline }}</p>
    </div>
    <div class="col-sm-6">
        <p><b>Lang from :</b> {{ ($activity->langFrom)? $activity->langFrom->name : '-' }}</p>
        <p><b>Lang to :</b> {{ ($activity->langTo)? $activity->langTo->name : '-' }}</p>
    </div>
</div>


