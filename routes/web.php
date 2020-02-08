<?php

Route::get('/', function () {
//    return view('auth.login');
    return redirect(route('login'));
});

Auth::routes();

Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'],function (){
    // User update data
    Route::get('user/profile', 'UsersController@showUserProfile')->name('users.showUserProfile');
    Route::put('users/{user}/update_password', 'UsersController@updatePassword')->name('users.update_password');

    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('permission-groups', 'PermissionGroupsController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('leads', 'LeadsController');
    Route::resource('certificates', 'CertificatesController');
    Route::resource('courses', 'CoursesController');
    Route::post('courses/student/store', 'CoursesController@addStudent')->name('courses.student.store');
    Route::get('courses/certificates/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditCertificates')->name('courses.certificates.show');
    Route::post('courses/certificates/{course_uuid}/{student_uuid}', 'CoursesController@storeStudentCertificates')->name('courses.certificates.store');
    Route::get('courses/payments/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditPayments')->name('courses.payments');
    Route::resource('students', 'StudentsController');
    Route::resource('trainers', 'TrainersController');
    Route::resource('locations', 'LocationsController');
});
