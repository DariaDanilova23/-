<?php

namespace App\Http\Controllers;

use App\Models\ActiveCourse;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome',[
            'rows'=>Report::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function professor (){
        return view('professors');
    }

    public function eachBest(){
        Report::truncate();
        $eachBest=array();
        foreach (Professor::with('activeCourse')->get() as $record) {
            $st=new ActiveCourse();
            $eachBest[$record['id']]['FIO']=$record['FIO'];
            $students=Student::whereIn('id',$st->best($record['activeCourse']))->pluck('FIO');
            $eachBest[$record['id']]['FIO_student']=preg_replace(array('/\[/', '/\]/','/\"/'), '', $students);
        }
        return view('welcome',['eachBest'=>$eachBest]);
    }
    public function bestStudent()
    {
        Report::truncate();
        $best= array();
        foreach (ActiveCourse::with('student')->get() as $record) {
            $st=new ActiveCourse();
            $best[$record['student']['id']]['FIO']=$record['student']['FIO'];
            $best[$record['student']['id']]['grade']=$st->average($record);
        }
        arsort($best);
        return view('welcome',['studentChart'=>$best]);
    }
    public function mainReport()
    {
        Report::truncate();
        $reportActive= array();
        foreach (Professor::with('activeCourse')->get() as $record) {
            $st=new ActiveCourse();
            $reportActive[$record['id']]['FIO']=$record['FIO'];
            $average=0;
            foreach ($record['activeCourse'] as $mark){
                $average+=$st->average($mark);
            }
            $reportActive[$record['id']]['grade']=$average;
            $reportActive[$record['id']]['amount']=count($record['activeCourse']);
        }
        return view('welcome',['professorChart'=>$reportActive]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
