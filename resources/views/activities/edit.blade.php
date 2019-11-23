<form method="post" action="{{ route('activities.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="client">Client</label>
                <select id="client" class="select2 form-control{{ $errors->has('client') ? ' is-invalid' : '' }}" name="client">
                    @foreach($clients as $client)
                        <option @if($client->id == $resource->client_id) selected @endif value="{{$client->id}}">{{ $client->name }} {{ ($client->company)? ' - ' . $client->company->name : '' }}</option>
                    @endforeach
                </select>

                @if ($errors->has('client'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('client') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="project_manger">Project manger</label>
                <select id="project_manger" class="select2 form-control{{ $errors->has('project_manger') ? ' is-invalid' : '' }}" name="project_manger">
                    @foreach($users as $user)
                        <option @if($user->id == $resource->project_manger_id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('project_manger'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('project_manger') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="num_of_words">Num of words</label>
                <input id="num_of_words" type="text" autocomplete="off" class="form-control{{ $errors->has('num_of_words') ? ' is-invalid' : '' }}" name="num_of_words" value="{{ $resource->num_of_words }}" required>

                @if ($errors->has('num_of_words'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('num_of_words') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="num_of_papers">Num of papers</label>
                <input id="num_of_papers" type="text" autocomplete="off" class="form-control{{ $errors->has('num_of_papers') ? ' is-invalid' : '' }}" name="num_of_papers" value="{{ $resource->num_of_papers }}" required>

                @if ($errors->has('num_of_papers'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('num_of_papers') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="lang_from">Lang from</label>
                <select id="lang_from" class="select2 form-control{{ $errors->has('lang_from') ? ' is-invalid' : '' }}" name="lang_from">
                    @foreach($languages as $language)
                        <option @if($language->id == $resource->lang_from) selected @endif value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('lang_from'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lang_from') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="lang_to">Lang to</label>
                <select id="lang_to" class="select2 form-control{{ $errors->has('lang_to') ? ' is-invalid' : '' }}" name="lang_to">
                    @foreach($languages as $language)
                        <option @if($language->id == $resource->lang_to) selected @endif value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('lang_to'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lang_to') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="task_name">Task name</label>
                <input id="task_name" type="text" autocomplete="off" class="form-control{{ $errors->has('task_name') ? ' is-invalid' : '' }}" name="task_name" value="{{ $resource->task_name }}" required>

                @if ($errors->has('task_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('task_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="task_type">Task type</label>
                <input id="task_type" type="text" autocomplete="off" class="form-control{{ $errors->has('task_type') ? ' is-invalid' : '' }}" name="task_type" value="{{ $resource->task_type }}" required>

                @if ($errors->has('task_type'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('task_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="rate">Rate</label>
                <input id="rate" type="text" autocomplete="off" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ $resource->rate }}" required>

                @if ($errors->has('rate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('rate') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="deadline">Deadline</label>
                <input id="deadline" type="date" autocomplete="off" class="form-control{{ $errors->has('deadline') ? ' is-invalid' : '' }}" name="deadline" value="{{ $resource->deadline }}" required>

                @if ($errors->has('deadline'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('deadline') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="activity_status">Activity status</label>
                <select id="activity_status" class="select2 form-control{{ $errors->has('activity_status') ? ' is-invalid' : '' }}" name="activity_status">
                    @foreach($activity_statuses as $activity_status)
                        <option @if($activity_status->id == $resource->activity_status) selected @endif value="{{ $activity_status->id }}">{{ $activity_status->name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('activity_status'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('activity_status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="comments">Comments</label>
                <input id="comments" type="text" autocomplete="off" class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" value="{{ $resource->comments }}" required>

                @if ($errors->has('comments'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('comments') }}</strong>
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