<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Trainer;
use App\User;
use Validator;
use Illuminate\Http\Request;

class CertificatesController extends Controller
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
        $this->resource = new Certificate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.certificates')){
            return redirect('/');
        }

        $data['resources'] = Certificate::all();

        return view('certificates.index', $data);
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
        if (!User::hasAuthority('store.certificates')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Certificate::store([
            'name' => $request->name,
            'comments' => $request->comments,
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
        if (!User::hasAuthority('edit.certificates')){
            return redirect('/');
        }

        $data['resource'] = Certificate::getBy('uuid', $uuid);
        return response([
            'title'=> "Update resource " . $data['resource']->name,
            'view'=> view('certificates.edit', $data)->render(),
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
        if (!User::hasAuthority('update.certificates')){
            return redirect('/');
        }

        // Get Resource
        $resource = Certificate::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Certificate::edit([
            'name' => $request->name,
            'comments' => $request->comments,
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
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (!User::hasAuthority('delete.certificates')){
            return redirect('/');
        }

        $resource = Certificate::getBy('uuid', $uuid);

        if ($resource){

            $deletedResource = Certificate::remove($resource->id);

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
