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
    Route::resource('certificates', 'CertificatesController');
    Route::resource('courses', 'CoursesController');
    Route::post('courses/student/store', 'CoursesController@addStudent')->name('courses.student.store');
    Route::get('courses/certificates/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditCertificates')->name('courses.certificates');
    Route::get('courses/payments/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditPayments')->name('courses.payments');
    Route::resource('students', 'StudentsController');
    Route::resource('trainers', 'TrainersController');
    Route::resource('locations', 'LocationsController');
});
