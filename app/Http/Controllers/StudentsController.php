<?php

namespace App\Http\Controllers;

use App\CoursePrice;
use App\Nationality;
use App\Student;
use App\Course;
use App\User;
use Validator;
use DB;
use Illuminate\Http\Request;

class StudentsController extends Controller
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
        $this->resource = new Student();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!User::hasAuthority('index.students')){
            return redirect('/');
        }

//        dd($request->all());

        if ($request->has('name') || $request->has('phone') || $request->has('email')){
            $data['resources'] = Student::where('name','like', "%$request->name%")
                ->orWhere('phone', $request->phone)
                ->paginate(20);
        }else{
            $data['resources'] = Student::paginate(20);
        }

        $data['courses'] = Course::all();
        $data['nationalities'] = Nationality::all();
        $data['sales'] = User::where('user_type_id', 2)->get(); // Sales

        return view('students.index', $data);
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
        if (!User::hasAuthority('store.students')){
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|max:20',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $resource = Student::store([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'comments' => $request->comments,
            'nationality' => $request->nationality,
            'created_by' => auth()->user()->id,
        ]);

        // Add Courses
        if($request->has('courses')){
            foreach ($request->courses as $course_uuid){
                $course = Course::getBy('uuid', $course_uuid);
                if($course){
                    $resource->courses()->attach($course->id);
                }
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
        if (!User::hasAuthority('edit.students')){
            return redirect('/');
        }

        $data['resource'] = Student::getBy('uuid', $uuid);
        $data['courses'] = Course::all();
        $data['nationalities'] = Nationality::all();

        return response([
            'title'=> "Update resource : <span class='text-danger'>" . $data['resource']->name . "</span>",
            'view'=> view('students.edit', $data)->render(),
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
        if (!User::hasAuthority('update.students')){
            return redirect('/');
        }

        // Get Resource
        $resource = Student::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
//            'address' => 'required|max:20',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        // Do Code
        $updatedResource = Student::edit([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'comments' => $request->comments,
            'nationality' => $request->nationality,
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Add Courses
        if($request->has('courses')){
            foreach ($request->courses as $course_uuid){
                $course = Course::getBy('uuid', $course_uuid);
                if($course){
                    $resource->courses()->attach($course->id);
                }
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
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if (!User::hasAuthority('delete.students')){
            return redirect('/');
        }

        $resource = Student::getBy('uuid', $uuid);
        if ($resource){

            $deletedResource = Student::remove($resource->id);

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

    /*
     * showOrEditCourses
     * */
    public function showOrEditCourses($student_uuid){

        if (!User::hasAuthority('edit.students')){
            return redirect('/');
        }

        $data['student'] = Student::getBy('uuid', $student_uuid);

        $data['courses'] = Course::where('is_active', 1)->get();

        $data['prices'] = CoursePrice::all();

        $data['studentCourses'] = DB::table('course_student')->where('student_id', $data['student']->id)->get();

        $data['sales'] = User::where('user_type_id', 2)->get(); // Sales

        $data['title'] = "Courses For : <span class='text-danger'>" . $data['student']->name . "</span>";

        return response([
            'view'=> view('students.courses.index', $data)->render(),
        ]);
    }

    /*
     * storeStudentCourses
     * */
    public function storeStudentCourses(Request $request, $student_uuid){

        $course = Course::getBy('uuid', $request->course);
        $sales = ($request->has('sales') && $request->sales != '0' ) ? User::getBy('uuid', $request->sales)->id : null;
        $student = Student::getBy('uuid', $student_uuid);
        $price = CoursePrice::getBy('uuid', $request->price);

        if($course){
            $studentCourses = DB::table('course_student')
                ->where('course_id', $course->id)
                ->where('student_id', $student->id)
                ->first();

            if($student){
                if ($studentCourses) {
                    $data['message'] = [
                        'msg_status' => 0,
                        'type' => 'danger',
                        'text' => 'This course added before for this student',
                    ];
                }else{
                    $course->students()->attach($student->id, [
                        'sales_id' => $sales,
                        'course_price_id' => $price->id,
                        'joined_at' => $request->joined_at,
                        'attendance_type' => $request->attendance_type,
                    ]);

                    $data['message'] = [
                        'msg_status' => 1,
                        'type' => 'success',
                        'text' => 'Created Successfully',
                    ];
                }
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'type' => 'danger',
                    'text' => 'Student Not Exists',
                ];
            }
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Course Not Exists',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Edit Student Course
     */
    public function editStudentCourses($student_course_id)
    {
        $data['studentCourse'] = DB::table('course_student')->where('id', $student_course_id)->first();

        $data['course'] = Course::getBy('id', $data['studentCourse']->course_id);

        $data['courses'] = Course::where('is_active', 1)->get();

        $data['prices'] = CoursePrice::all();

        $data['sales'] = User::where('user_type_id', 2)->get(); // Sales

        $data['title'] = "Courses For : <span class='text-danger'>" . $data['course']->name . "</span>";

        return response([
            'title' => $data['title'],
            'view' => view('students.courses.edit', $data)->render(),
        ]);
    }

    /*
     * updateStudentCourses
     * */
    public function updateStudentCourses(Request $request, $student_course_id){

        $data['studentCourse'] = DB::table('course_student')->where('id', $student_course_id)->first();

        $course = Course::getBy('uuid', $request->course);
        $sales = ($request->has('sales') && $request->sales != '0' ) ? User::getBy('uuid', $request->sales)->id : null;
        $price = CoursePrice::getBy('uuid', $request->price);

        if($course){
            DB::table('course_student')->where('id', $student_course_id)->update([
                'sales_id' => $sales,
                'course_price_id' => $price->id,
                'joined_at' => $request->joined_at,
                'attendance_type' => $request->attendance_type,
            ]);

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Updated Successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Course Not Exists',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /*
     * showOrEditCertificates
     * */
    public function showOrEditCertificates($student_uuid){

    }

    /*
     * showOrEditPayments
     * */
    public function showOrEditPayments($student_uuid){

    }
    /*
     * showOrEditPayments
     * */
    public function destroyStudentCourses($student_course_id){
        $studentCourse = DB::table('course_student')->where('id', '=', $student_course_id)->first();

        if($studentCourse){
            DB::table('course_student')->where('id', '=', $student_course_id)->delete();

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Deleted Successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Student Course Not Exists',
            ];
        }

        return back()->with('message', $data['message']);
    }
}
