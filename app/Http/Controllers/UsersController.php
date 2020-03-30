<?php

namespace App\Http\Controllers;

use App\Permission;
use App\PermissionGroup;
use App\Role;
use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
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
        $this->resource = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.users')){
            return redirect('/');
        }
        $data['roles'] = Role::all();
        $data['resources'] = User::all();
        $data['types'] = UserType::all();
        return view('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (!User::hasAuthority('store.users')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|max:20',
            'password' => 'required|string|min:6',
            'type' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = User::store([
            'user_type_id' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 1,
            'password' => bcrypt($request->password),
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id
        ]);

        // Relation
        if ($resource){
            foreach ($request->input('roles') as $role){
                $resource->roles()->attach(Role::getBy('uuid', $role)->id);
            }
        }

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
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        if (!User::hasAuthority('edit.users')){
            return redirect('/');
        }

        $data['roles'] = Role::all();
        $data['resource'] = User::getBy('uuid', $uuid);
        $data['types'] = UserType::all();

        return response([
            'title'=> "Update user " . $data['resource']->name,
            'view'=> view('users.edit', $data)->render(),
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
        if (!User::hasAuthority('update.users')){
            return redirect('/');
        }

        // Get Resource
        $resource = User::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $resource->id,
            'phone' => 'required|max:20',
            'type' => 'required',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = User::edit([
            'user_type_id' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => ($request->has('password')? bcrypt($request->password) : $resource->password),
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Relation
        if ($request->has('roles')){
            $resource->roles()->detach();

            foreach ($request->input('roles') as $role){
                $resource->roles()->attach(Role::getBy('uuid', $role)->id);
            }
        }

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
     * Show user profile.
     */
    public function showUserProfile()
    {
        if (!User::hasAuthority('show.users')){
            return redirect('/');
        }

        $data['user'] = User::getBy('id', auth()->user()->id);
        return view('users.profile.show', $data);
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request,$user)
    {
        if (!User::hasAuthority('update_password.users')){
            return redirect('/');
        }

        // Get Resource
        $resource = User::getBy('uuid', $user);

        if($resource){
            $resource->password = bcrypt($request->password);
            $resource->save();

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Password updated successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Sorry! User not exists.',
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
        if (!User::hasAuthority('delete.users')){
            return redirect('/');
        }

        $resource = User::getBy('uuid', $uuid);
        if ($resource){
            $deletedResource = User::remove($resource->id);

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
