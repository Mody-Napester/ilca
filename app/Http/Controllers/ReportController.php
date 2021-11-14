<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\User;
use Validator;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Get Students Report.
     */
    public function getStudentsReport(Request $request)
    {
        $data['courses'] = Course::all();

        if ($request->has('name') || $request->has('phone') || $request->has('email')){

            $data['students'] = new Student();

            if($request->has('name') && $request->name != ''){
                $data['students'] = $data['students']->where('name','like', "%$request->name%");
            }

            if($request->has('phone') && $request->phone != ''){
                $data['students'] = $data['students']->where('phone','like', "%$request->phone%");
            }

            if($request->has('email') && $request->email != ''){
                $data['students'] = $data['students']->where('email','like', "%$request->email%");
            }

            $data['students'] = $data['students']->get();

        }else{
            if($request->has('getall') && $request->getall == 'yes'){
                $data['students'] = Student::all();
            }else{
                $data['students'] = Student::paginate(50);
            }
        }

        return view('reports.students', $data);
    }

    /**
     * Get Payments Report.
     */
    public function getPaymentsReport(Request $request)
    {
        if ($request->has('name') || $request->has('phone') || $request->has('email')){

            $data['students'] = new Student();

            if($request->has('name') && $request->name != ''){
                $data['students'] = $data['students']->where('name','like', "%$request->name%");
            }

            if($request->has('phone') && $request->phone != ''){
                $data['students'] = $data['students']->where('phone','like', "%$request->phone%");
            }

            if($request->has('email') && $request->email != ''){
                $data['students'] = $data['students']->where('email','like', "%$request->email%");
            }

            $data['students'] = $data['students']->get();

        }else{
            if($request->has('getall') && $request->getall == 'yes'){
                $data['students'] = Student::all();
            }else{
                $data['students'] = Student::paginate(50);
            }
        }

        return view('reports.payments', $data);
    }
}
