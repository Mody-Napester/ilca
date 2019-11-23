<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityPayment;
use App\ActivityPaymentStatus;
use App\ActivityStatus;
use App\Client;
use App\Company;
use App\Language;
use App\User;
use Validator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Class object
     * @var resource
     */
    public $resource;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->resource = new Activity();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.activities')){
            return redirect('/');
        }

        $data['resources'] = Activity::all();
        $data['companies'] = Company::all();
        $data['clients'] = Client::all();
        $data['users'] = User::all();
        $data['languages'] = Language::all();
        $data['activity_statuses'] = ActivityStatus::all();
        $data['payment_statuses'] = ActivityPaymentStatus::all();

        return view('activities.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('store.activities')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'client' => 'required',
            'num_of_words' => 'required',
            'num_of_papers' => 'required',
            'lang_from' => 'required',
            'lang_to' => 'required',
            'task_name' => 'required',
            'task_type' => 'required',
            'rate' => 'required',
            'project_manger' => 'required',
            'deadline' => 'required',
            'activity_status' => 'required',

        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Activity::store([
            'client_id'=> $request->client,
            'num_of_words'=> $request->num_of_words,
            'num_of_papers'=> $request->num_of_papers,
            'lang_from'=> $request->lang_from,
            'lang_to'=> $request->lang_to,
            'task_name'=> $request->task_name,
            'task_type'=> $request->task_type,
            'rate'=> $request->rate,
            'project_manger_id'=> $request->project_manger,
            'deadline'=> $request->deadline,
            'activity_status_id'=> $request->activity_status,
            'comments' => (($request->has('comments'))? $request->comments : ''),
            'created_by' => auth()->user()->id,
        ]);

        // Do Code
        $resource = ActivityPayment::store([
            'activity_id'=> $resource->id,
            'activity_payment_status_id'=> $request->activity_payment_status,
            'amount'=> $request->amount,
            'effect'=> $request->effect,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if ($resource){
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $data['resource'] = Activity::getBy('uuid', $uuid);
        $data['companies'] = Company::all();
        $data['clients'] = Client::all();
        $data['users'] = User::all();
        $data['languages'] = Language::all();
        $data['activity_statuses'] = ActivityStatus::all();

        return response([
            'title'=> "Update resource " . $data['resource']->name,
            'view'=> view('activities.edit', $data)->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Check permissions

        // Get Resource
        $resource = Activity::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'client' => 'required',
            'num_of_words' => 'required',
            'num_of_papers' => 'required',
            'lang_from' => 'required',
            'lang_to' => 'required',
            'task_name' => 'required',
            'task_type' => 'required',
            'rate' => 'required',
            'project_manger' => 'required',
            'deadline' => 'required',
            'activity_status' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Activity::edit([
            'client_id'=> $request->client,
            'num_of_words'=> $request->num_of_words,
            'num_of_papers'=> $request->num_of_papers,
            'lang_from'=> $request->lang_from,
            'lang_to'=> $request->lang_to,
            'task_name'=> $request->task_name,
            'task_type'=> $request->task_type,
            'rate'=> $request->rate,
            'project_manger_id'=> $request->project_manger,
            'deadline'=> $request->deadline,
            'activity_status_id'=> $request->activity_status,
            'comments' => (($request->has('comments'))? $request->comments : ''),
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Return
        if ($updatedResource){
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $resource = Activity::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Activity::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }

    }
}
