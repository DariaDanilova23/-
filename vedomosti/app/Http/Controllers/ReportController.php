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
        }
        /*
            $row->FIO =DB::table('professors')->get()->value('FIO');
                ->join('courses', 'professors.id', '=', 'courses.id_professor')
                ->join('active_courses', 'courses.id', '=', 'active_courses.id_course')
                ->select('professors.*')->get()->value('FIO');
            $row->Amount = DB::table('professors')
                ->join('courses', 'professors.id', '=', 'courses.id_professor')
                ->join('active_courses', 'courses.id', '=', 'active_courses.id_course')
                ->select('active_courses.id_student')->count();
            $row->Average_grade = DB::table('professors')
                ->join('courses', 'professors.id', '=', 'courses.id_professor')
                ->join('active_courses', 'courses.id', '=', 'active_courses.id_course')
                ->select('active_courses.grade')->get()->value('0');
            $row->save();*/
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
