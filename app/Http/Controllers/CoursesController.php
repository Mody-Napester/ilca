<?php

namespace App\Http\Controllers;

use App\Course;
use App\Location;
use App\Student;
use App\Trainer;
use App\User;
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

        // Return
        if ($resource) {
            return back();
        }
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
        }

        return back();

    }

    /**
     * Add Student to course.
     */
    public function showOrEditCertificates(Request $request)
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

        // Return
        if ($updatedResource) {
            return back();
        }
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
            if ($deletedResource) {
                return back();
            }
        }

    }
}
