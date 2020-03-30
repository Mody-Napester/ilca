<?php

namespace App\Http\Controllers;

use App\CoursePrice;
use App\Currency;
use App\User;
use Illuminate\Http\Request;
use Validator;

class CoursePricesController extends Controller
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
        $this->resource = new CoursePrice();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.course_prices')) {
            return redirect('/');
        }

        $data['resources'] = CoursePrice::all();
        $data['currencies'] = Currency::all();

        return view('course_prices.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('store.course_prices')) {
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'currency' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = CoursePrice::store([
            'price' => $request->price,
            'currency_id' => $request->currency,
            'created_by' => auth()->user()->id,
        ]);

        // Return
        if ($resource){
            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Created Successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Error!',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        if (!User::hasAuthority('show.course_prices')) {
            return redirect('/');
        }

        $data['course_price'] = CoursePrice::getBy('uuid', $uuid);
        $data['currencies'] = Currency::all();

        return view('course_prices.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        if (!User::hasAuthority('edit.course_prices')) {
            return redirect('/');
        }

        $data['resource'] = CoursePrice::getBy('uuid', $uuid);
        $data['currencies'] = Currency::all();

        return response([
            'title' => "Update resource " . $data['resource']->name,
            'view' => view('course_prices.edit', $data)->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Check permissions
        if (!User::hasAuthority('update.course_prices')) {
            return redirect('/');
        }

        // Get Resource
        $resource = CoursePrice::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'currency' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = CoursePrice::edit([
            'price' => $request->price,
            'currency_id' => $request->currency,
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Return
        if ($updatedResource){
            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Updated Successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Error!',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (!User::hasAuthority('delete.course_prices')) {
            return redirect('/');
        }

        $resource = CoursePrice::getBy('uuid', $uuid);
        if ($resource) {

            $deletedResource = CoursePrice::remove($resource->id);

            // Return
            if ($deletedResource){
                $data['message'] = [
                    'msg_status' => 1,
                    'type' => 'success',
                    'text' => 'Deleted Successfully',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'type' => 'danger',
                    'text' => 'Error!',
                ];
            }
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Not Exists!',
            ];
        }

        return back()->with('message', $data['message']);

    }
}
