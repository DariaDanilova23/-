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

    public function bestStudent()
    {
        Report::truncate();
        $i=0;
        foreach (ActiveCourse::with('student')->get() as $record) {
            $row = new Report;//---
            $best= array();
            $st=new ActiveCourse();
            $row->FIO=$record['student']['FIO'];//---
            $best[$i]['FIO']=$record['student']['FIO'];
            $row->Amount=0;//----
            $row->Average_grade = $st->average($record);//-------
            $best[$i]['grade']=$st->average($record);
            $row->save();//-------
            $i++;
        }
        return $this->index();
    }
    public function create()
    {
        Report::truncate();
        $i=0;
        foreach (Professor::with('activeCourse')->get() as $record) {
            $row = new Report;//-----------
            $reportActive= array();
            $st=new ActiveCourse();
            $reportActive[$i]['FIO']=$record['FIO'];
            $row->FIO=$reportActive[$i]['FIO'];//-------
            $average=0;
            foreach ($record['activeCourse'] as $mark){
                $average+=$st->average($mark);
            }
            $reportActive[$i]['grade']=$average;
            $row->Average_grade=$reportActive[$i]['grade'];//------------
            $reportActive[$i]['amount']=count($record['activeCourse']);
            $row->Amount=$reportActive[$i]['amount'];//-----
            $row->save();//-----------
            $i++;
        }
        return $this->index();
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
