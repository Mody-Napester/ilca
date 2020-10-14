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
    Route::resource('course_prices', 'CoursePricesController');

    Route::resource('courses', 'CoursesController');
    Route::post('courses/student/store', 'CoursesController@addStudent')->name('courses.student.store');
    Route::get('courses/certificates/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditCertificates')->name('courses.certificates.show');
    Route::post('courses/certificates/{course_uuid}/{student_uuid}', 'CoursesController@storeStudentCertificates')->name('courses.certificates.store');
    Route::get('courses/payments/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditPayments')->name('courses.payments.show');
    Route::post('courses/payments/{course_uuid}/{student_uuid}', 'CoursesController@storeStudentPayments')->name('courses.payments.store');
    Route::get('courses/research/{course_uuid}/{student_uuid}', 'CoursesController@showOrEditResearch')->name('courses.research.show');
    Route::post('courses/research/{course_uuid}/{student_uuid}', 'CoursesController@storeStudentResearch')->name('courses.research.store');

    Route::resource('students', 'StudentsController');
    Route::get('students/courses/{student_uuid}', 'StudentsController@showOrEditCourses')->name('students.courses.index');
    Route::post('students/courses/{student_uuid}', 'StudentsController@storeStudentCourses')->name('students.courses.store');
    Route::get('students/courses/edit/{student_course_id}', 'StudentsController@editStudentCourses')->name('students.courses.edit');
    Route::post('students/courses/update/{student_course_id}', 'StudentsController@updateStudentCourses')->name('students.courses.update');
    Route::delete('students/courses/destroy/{student_course_id}', 'StudentsController@destroyStudentCourses')->name('students.courses.destroy');

    Route::get('students/certificates/{student_uuid}', 'StudentsController@showOrEditCertificates')->name('students.certificates.index');

    Route::resource('trainers', 'TrainersController');
    Route::resource('locations', 'LocationsController');
});
