<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\User;
use Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        $this->resource = new Client();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.clients')){
            return redirect('/');
        }

        $data['resources'] = Client::all();
        $data['companies'] = Company::all();
        return view('clients.index', $data);
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
        if (!User::hasAuthority('store.clients')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone' => 'required|max:20',
            'type' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Client::store([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'address' => (($request->has('address'))? $request->address : ''),
            'comments' => (($request->has('comments'))? $request->comments : ''),
            'company_id' => (($request->has('company'))? $request->company : 0),
            'country_id' => (($request->has('country'))? $request->country : 0),
            'city_id' => (($request->has('city'))? $request->city : 0),
            'area_id' => (($request->has('area'))? $request->area : 0),
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
        $data['resource'] = Client::getBy('uuid', $uuid);
        return response([
            'title'=> "Update resource " . $data['resource']->name,
            'view'=> view('clients.edit', $data)->render(),
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
        $resource = Client::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $resource->id,
            'phone' => 'required|max:20',
            'type' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Client::edit([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'address' => (($request->has('address'))? $request->address : ''),
            'comments' => (($request->has('comments'))? $request->comments : ''),
            'company_id' => (($request->has('company'))? $request->company : 0),
            'country_id' => (($request->has('country'))? $request->country : 0),
            'city_id' => (($request->has('city'))? $request->city : 0),
            'area_id' => (($request->has('area'))? $request->area : 0),
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
        $resource = Client::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Client::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }

    }
}
