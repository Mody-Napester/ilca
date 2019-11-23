<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use Validator;
use Illuminate\Http\Request;

class LeadsController extends Controller
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
        $this->resource = new Lead();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (!User::hasAuthority('index.leads')){
//            return redirect('/');
//        }
        $data['resources'] = Lead::all();
        return view('leads.index', $data);
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
        if (!User::hasAuthority('index.leads')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:leads',
            'phone' => 'required|max:20',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Lead::store([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
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
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data['resource'] = Lead::getBy('uuid', $uuid);
        return response([
            'title'=> "Update resource " . $data['resource']->name,
            'view'=> view('leads.edit', $data)->render(),
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
        $resource = Lead::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:leads,email,' . $resource->id,
            'phone' => 'required|max:20',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Lead::edit([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
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
        $resource = Lead::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Lead::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }

    }
}
