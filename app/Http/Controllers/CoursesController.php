<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Course;
use App\CoursePrice;
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
    public function index(Request $request)
    {
        if (!User::hasAuthority('index.courses')) {
            return redirect('/');
        }

        $data['trainers'] = Trainer::all();
        $data['prices'] = CoursePrice::all();
        $data['locations'] = Location::all();
        $data['certificates'] = Certificate::all();

        if(!empty($request->all())){
            $data['resources'] = new Course();

            if($request->has('title')){
                $data['resources'] = Course::where('title', 'like', "%".$request->title."%");
            }

            $data['resources'] = $data['resources']->get();
        }else{
            $data['resources'] = Course::all();
        }

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

//        dd($request->all());

        // Check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:courses,title',
            'details' => 'required',
            'location' => 'required',
//            'price_egp' => 'required',
//            'price_usd' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'prices' => 'required',
            'is_active' => 'required',
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
            'price_egp' => 1,//$request->price_egp,
            'price_usd' => 1,//$request->price_usd,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'is_active' => (int)$request->is_active,
            'comments' => ($request->has('comments'))? $request->comments : '-',
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

        // Add Prices
        if ($request->has('prices')) {
            foreach ($request->prices as $price_uuid) {
                $price = CoursePrice::getBy('uuid', $price_uuid);
                if ($price) {
                    $resource->prices()->attach($price->id);
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
        if (!User::hasAuthority('show.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $uuid);

        if(empty($data['course'])){
            return redirect('/');
        }

        $data['students'] = Student::all();
        $data['sales'] = User::where('user_type_id', 2)->get(); // Sales
        $data['prices'] = CoursePrice::all();

        return view('courses.show', $data);

    }

    /**
     * Add Student to course.
     */
    public function addStudent(Request $request)
    {
        if (!User::hasAuthority('courses.add_student')) {
            return redirect('/');
        }

        $course = Course::getBy('uuid', $request->course_uuid);

        $sales = ($request->has('sales')) ? User::getBy('uuid', $request->sales)->id : null;

        $price = CoursePrice::getBy('uuid', $request->price);

//        dd($sales);
        if($course){
            // Add Courses
            if ($request->has('students')) {

//                $course->students()->detach();

                $student = Student::getBy('uuid', $request->students);
                if ($student) {
                    $course->students()->attach($student->id, [
                        'sales_id' => $sales,
                        'course_price_id' => $price->id,
                    ]);
                }
//
//                foreach ($request->students as $student_uuid) {
//
//                }
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
        if (!User::hasAuthority('show_edit_certificates.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        if($data['course']){
            return response([
                'title' => "Certificates for : <span class='text-danger'>" . $data['student']->name . "</span>",
                'view' => view('courses._certificates', $data)->render(),
            ]);
        }
    }

    /**
     * Store Student Certificates.
     */
    public function storeStudentCertificates(Request $request, $course_uuid, $student_uuid)
    {
        if (!User::hasAuthority('store_student_certificates.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        if($data['course']){
            // Add Certificates
            if ($request->has('certificates')) {
                foreach ($request->certificates as $key => $certificate_uuid) {
                    $certificate = Certificate::getBy('uuid', $certificate_uuid);

                    if ($certificate) {
                        DB::table('course_student_certificate')->insert([
                           'course_id' => $data['course']->id,
                           'student_id' => $data['student']->id,
                           'certificate_id' => $certificate->id,
                           'date' => $request->dates[$key],
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
     * Show Or Edit Payments.
     */
    public function showOrEditPayments($course_uuid, $student_uuid)
    {
        if (!User::hasAuthority('show_edit_payments.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);
        $studentCourses = DB::table('course_student')
            ->where('course_id', $data['course']->id)
            ->where('student_id', $data['student']->id)
            ->first();
        $data['price'] = CoursePrice::getBy('id', $studentCourses->course_price_id);

        $data['payments'] = DB::table('course_payment')
            ->where('course_id', $data['course']->id)
            ->where('student_id', $data['student']->id);

        $data['sumPayments'] = $data['payments']->sum('amount');
        $data['allPayments'] = $data['payments']->get();

        if($data['course']){
            return response([
                'title' => "Payments for : <span class='text-danger'>" . $data['student']->name . "</span>",
                'view' => view('courses._payments', $data)->render(),
            ]);
        }

    }

    /**
     * Store Student Payments.
     */
    public function storeStudentPayments(Request $request, $course_uuid, $student_uuid)
    {
        if (!User::hasAuthority('store_student_certificates.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        $studentCourses = DB::table('course_student')
            ->where('course_id', $data['course']->id)
            ->where('student_id', $data['student']->id)
            ->first();
        $data['price'] = CoursePrice::getBy('id', $studentCourses->course_price_id);

        $data['sumPayments'] = DB::table('course_payment')
            ->where('course_id', $data['course']->id)
            ->where('student_id', $data['student']->id)
            ->sum('amount');

        if($data['course']){
            // Add Payments
            if ($request->has('amount') && $request->amount <= $data['sumPayments'] && $request->amount != 0) {
                DB::table('course_payment')->insert([
                    'course_id' => $data['course']->id,
                    'student_id' => $data['student']->id,
                    'amount' => $request->amount,
                    'date' => $request->date,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id
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
                    'text' => 'Amount must be between 1 to ' . ($data['price']->price - $data['sumPayments']) . ' ' . $data['price']->currency->code,
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
     * Show Or Edit Research.
     */
    public function showOrEditResearch($course_uuid, $student_uuid)
    {
        if (!User::hasAuthority('show_edit_payments.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);
        $data['researches'] = DB::table('course_research')
            ->where('course_id', $data['course']->id)
            ->where('student_id', $data['student']->id)
            ->get();

        if($data['course']){
            return response([
                'title' => "Researches for : <span class='text-danger'>" . $data['student']->name . "</span>",
                'view' => view('courses._research', $data)->render(),
            ]);
        }

    }

    /**
     * Store Student Research.
     */
    public function storeStudentResearch(Request $request, $course_uuid, $student_uuid)
    {
        if (!User::hasAuthority('store_student_certificates.courses')) {
            return redirect('/');
        }

        $data['course'] = Course::getBy('uuid', $course_uuid);
        $data['student'] = Student::getBy('uuid', $student_uuid);

        if($data['course']){
            // Add Research
            if ($request->hasFile('research')) {
                $upload = upload_file('text', $request->file('research'), 'assets/images/research');
                if ($upload['status'] == true){
                    $research = $upload['filename'];

                    DB::table('course_research')->insert([
                        'course_id' => $data['course']->id,
                        'student_id' => $data['student']->id,
                        'research' => $research,
                        'date' => $request->date,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id
                    ]);

                    $data['message'] = [
                        'msg_status' => 1,
                        'type' => 'success',
                        'text' => 'Updated Successfully',
                    ];

                }else{
                    return back()->with('message',[
                        'type'=> 'danger',
                        'text'=> 'Image ' . $upload['message']
                    ]);
                }
            }else{
                $data['message'] = [
                    'msg_status' => 0,
                    'type' => 'danger',
                    'text' => 'Please attach research!',
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
     * Show the form for editing the specified resource.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        if (!User::hasAuthority('edit.courses')) {
            return redirect('/');
        }

        $data['resource'] = Course::getBy('uuid', $uuid);
        $data['trainers'] = Trainer::all();
        $data['locations'] = Location::all();
        $data['certificates'] = Certificate::all();
        $data['prices'] = CoursePrice::all();
        $data['sales'] = User::where('user_type_id', 2)->get();

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
        if (!User::hasAuthority('update.courses')) {
            return redirect('/');
        }

        // Get Resource
        $resource = Course::getBy('uuid', $uuid);

//        dd($request->all());

        // Check validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:courses,title,' . $resource->id,
            'details' => 'required',
            'location' => 'required',
//            'price_egp' => 'required',
//            'price_usd' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'prices' => 'required',
            'is_active' => 'required',
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
//            'price_egp' => $request->price_egp,
//            'price_usd' => $request->price_usd,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'is_active' => $request->is_active,
            'comments' => ($request->has('comments'))? $request->comments : '-',
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

        // Add Prices
        if ($request->has('prices')) {
            $resource->prices()->detach();
            foreach ($request->prices as $price_uuid) {
                $price = CoursePrice::getBy('uuid', $price_uuid);
                if ($price) {
                    $resource->prices()->attach($price->id);
                }
            }
        }

        // Add Certificates
        if ($request->has('certificates')) {
            $resource->certificates()->detach();
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
        if (!User::hasAuthority('delete.courses')) {
            return redirect('/');
        }

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
