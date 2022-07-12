<?php

namespace App\Http\Controllers;

use App\Models\ActiveCourse;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Report;
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
    public function create()
    {
        Report::truncate();
        foreach ($records=Professor::with('activeCourse')->get() as $record) {
            $row = new Report;
            $marks_sum=0;
            $amount=0;
            $row->FIO=$record['FIO'];
            foreach ($record['activeCourse'] as $marks){
                $marks_sum+=array_sum($marks['grade']);
                $amount+=count($marks['grade']);
            }
            if($amount==0) $row->Average_grade=0;
            else $row->Average_grade = $marks_sum/$amount;
            $row->Amount = count($record['activeCourse']);
            $row->save();
        }
      /*
        ///самое ок
        Report::truncate();
        foreach ($records=ActiveCourse::with('course','student')->get() as $record) {
            $row = new Report;
            $row->FIO = $record;
            $row->Average_grade = 0;
            $row->Amount = 0;
            $row->save();
        }
        ///*/
       /* foreach (ActiveCourse::with('course')->get() as $professors){
            $row = new Report;
            $row->FIO=$professors['id'];
            $row->Average_grade=0;
            $row->Amount=0;
            $row->save();
        }*/
       /* Report::truncate();
        foreach (Professor::all() as $professors){
            $row = new Report;
            $countMarks=0;
            $sumMarks=0;
            $average=0;
            $row->FIO=$professors['FIO'];
            $course=Course::all()->where('id_professor',$professors['id']);
            $sudentsOnCourse=0;
            foreach ($course as $courseItem){ //проход по каждому курсу преподавателя в таблице Course
                $activeCourse=ActiveCourse::all()->where('id_course',$courseItem['id']);
                $sudentsOnCourse+=$activeCourse->count();
                foreach ($activeCourse as $student) { //проход по каждому курсу преподавателя в таблице ActiveCourse
                    $sumMarks+=array_sum($student['grade']);
                    $countMarks+=count($student['grade']);
                    }
                if($countMarks!=0) {
                    $average = $sumMarks / $countMarks;//среднее арифметическое
                }
            }
            $row->Amount=$sudentsOnCourse;
            $row->Average_grade=$average;
            $row->save();
        }*/
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
