<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard routes
|--------------------------------------------------------------------------
|
| Here is where dashboard routes exists.
|
*/

Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'],function (){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('permission-groups', 'PermissionGroupsController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('leads', 'LeadsController');
    Route::resource('companies', 'CompanyController');
    Route::resource('clients', 'ClientController');
    Route::resource('activities', 'ActivityController');

    Route::get('activity-payments/{activity}', 'ActivityPaymentController@show')->name('activity-payments.show');
    Route::post('activity-payments/{activity}', 'ActivityPaymentController@store')->name('activity-payments.store');
});
