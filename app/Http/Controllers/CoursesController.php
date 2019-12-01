<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Course;
use App\Location;
use App\Student;
use App\Trainer;
use App\User;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Http\Request;

class CoursesController extends Controller
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
        $this->resource = new Course();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.courses')) {
            return redirect('/');
        }

        $data['resources'] = Course::all();
        $data['trainers'] = Trainer::all();
        $data['locations'] = Location::all();
        $data['certificates'] = Certificate::all();

        return view('courses.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check permissions
        if (!User::hasAuthority('store.courses')) {
            return redirect('/');
        }

        // Check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:courses,title',
            'details' => 'required',
            'location' => 'required',
            'price_egp' => 'required',
            'price_usd' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $location = Location::getBy('uuid', $request->location);

        if (!$location) {
            return back();
        }

        // Do Code
        $resource = Course::store([
            'title' => $request->title,
            'details' => $request->details,
            'location_id' => $location->id,
            'price_egp' => $request->price_egp,
            'price_usd' => $request->price_usd,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'comments' => $request->comments,
            'created_by' => auth()->user()->id,
        ]);

        // Add Trainers
        if ($request->has('trainers')) {
            foreach ($request->trainers as $trainer_uuid) {
                $trainer = Trainer::getBy('uuid', $trainer_uuid);
                if ($trainer) {
                    $resource->trainers()->attach($trainer->id);
                }
            }
        }

        // Add Certificates
        if ($request->has('certificates')) {
            foreach ($request->certificates as $certificate_uuid) {
                $certificate = Certificate::getBy('uuid', $certificate_uuid);
                if ($certificate) {
                    $resource->certificates()->attach($certificate->id);
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
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        if (!User::hasAuthority('index.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $uuid);
        $data['students'] = Student::all();

        return view('courses.show', $data);

    }

    /**
     * Add Student to course.
     */
    public function addStudent(Request $request)
    {
        $course = Course::getBy('uuid', $request->course_uuid);

        if($course){
            // Add Courses
            if ($request->has('students')) {

                $course->students()->detach();

                foreach ($request->students as $student_uuid) {
                    $student = Student::getBy('uuid', $student_uuid);
                    if ($student) {
                        $course->students()->attach($student->id);
                    }
                }
            }

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Created Successfully',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Not Exists',
            ];
        }

        return back()->with('message', $data['message']);

    }

    /**
     * Add Student to course.
     */
    public function showOrEditCertificates($course_uuid, $student_uuid)
    {
        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        if($data['course']){
            return response([
                'title' => "Certificates for " . $data['student']->name,
                'view' => view('courses._certificates', $data)->render(),
            ]);
        }
    }

    /**
     * Store Student Certificates.
     */
    public function storeStudentCertificates(Request $request, $course_uuid, $student_uuid)
    {
        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        if($data['course']){
            // Add Certificates
            if ($request->has('certificates')) {
                foreach ($request->certificates as $certificate_uuid) {
                    $certificate = Certificate::getBy('uuid', $certificate_uuid);

                    if ($certificate) {
                        DB::table('course_student_certificate')->insert([
                           'course_id' => $data['course']->id,
                           'student_id' => $data['student']->id,
                           'certificate_id' => $certificate->id,
                           'created_at' => Carbon::now()->toDateTimeString(),
                           'updated_at' => Carbon::now()->toDateTimeString(),
                           'created_by' => auth()->user()->id,
                           'updated_by' => auth()->user()->id
                        ]);
                    }
                }
            }

            $data['message'] = [
                'msg_status' => 1,
                'type' => 'success',
                'text' => 'Updated Successfully',
            ];

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'type' => 'danger',
                'text' => 'Not Exists',
            ];
        }

        return back()->with('message', $data['message']);
    }

    /**
     * Add Student to course.
     */
    public function showOrEditPayments(Request $request)
    {
        $course = Course::getBy('uuid', $request->course_uuid);

        if($course){
            // Add Courses
            if ($request->has('students')) {

                $course->students()->detach();

                foreach ($request->students as $student_uuid) {
                    $student = Student::getBy('uuid', $student_uuid);
                    if ($student) {
                        $course->students()->attach($student->id);
                    }
                }
            }
        }

        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data['resource'] = Course::getBy('uuid', $uuid);
        $data['trainers'] = Trainer::all();
        $data['locations'] = Location::all();
        $data['certificates'] = Certificate::all();

        return response([
            'title' => "Update resource " . $data['resource']->name,
            'view' => view('courses.edit', $data)->render(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        // Check permissions

        // Get Resource
        $resource = Course::getBy('uuid', $uuid);

        // Check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:courses,title,' . $resource->id,
            'details' => 'required',
            'location' => 'required',
            'price_egp' => 'required',
            'price_usd' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $location = Location::getBy('uuid', $request->location);

        if (!$location) {
            return back();
        }

        // Do Code
        $updatedResource = Course::edit([
            'title' => $request->title,
            'details' => $request->details,
            'location_id' => $location->id,
            'price_egp' => $request->price_egp,
            'price_usd' => $request->price_usd,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'comments' => $request->comments,
            'updated_by' => auth()->user()->id
        ], $resource->id);

        // Add Trainers
        if ($request->has('trainers')) {
            $resource->trainers()->detach();
            foreach ($request->trainers as $trainer_uuid) {
                $trainer = Trainer::getBy('uuid', $trainer_uuid);
                if ($trainer) {
                    $resource->trainers()->attach($trainer->id);
                }
            }
        }

        // Add Certificates
        if ($request->has('certificates')) {
            foreach ($request->certificates as $certificate_uuid) {
                $certificate = Certificate::getBy('uuid', $certificate_uuid);
                if ($certificate) {
                    $resource->certificates()->attach($certificate->id);
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
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $resource = Course::getBy('uuid', $uuid);
        if ($resource) {

            $deletedResource = Course::remove($resource->id);

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
