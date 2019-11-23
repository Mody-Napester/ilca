<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityPayment;
use App\ActivityPaymentStatus;
use App\User;
use Validator;
use Illuminate\Http\Request;

class ActivityPaymentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($activity)
    {
        if (!User::hasAuthority('show.activities')){
            return redirect('/');
        }

        $data['activity'] = Activity::getBy('uuid', $activity);
        $data['payment_statuses'] = ActivityPaymentStatus::all();
        return view('activities.payments.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $activity)
    {
        // Check permissions
        if (!User::hasAuthority('store.activities')){
            return redirect('/');
        }

        $activity = Activity::getBy('uuid', $activity);

        // Check validation
        $validator = Validator::make($request->all(), [
            'activity_payment_status' => 'required',
            'amount' => 'required',
            'effect' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = ActivityPayment::store([
            'activity_id'=> $activity->id,
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
}
