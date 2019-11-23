<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Validator;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $this->resource = new Company();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.companies')){
            return redirect('/');
        }

        $data['resources'] = Company::all();
        return view('companies.index', $data);
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
        if (!User::hasAuthority('store.companies')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'phone' => 'required|max:20',
            'website' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Company::store([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'comments' => $request->comments,
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
        $data['resource'] = Company::getBy('uuid', $uuid);
        return response([
            'title'=> "Update resource " . $data['resource']->name,
            'view'=> view('companies.edit', $data)->render(),
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
        $resource = Company::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies,email,' . $resource->id,
            'phone' => 'required|max:20',
            'website' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Company::edit([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'comments' => $request->comments,
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
        $resource = Company::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = Company::remove($resource->id);

            // Return
            if ($deletedResource){
                return back();
            }
        }

    }
}
