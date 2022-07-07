<?php

namespace App\Http\Controllers;

use App\Models\ActiveCourse;
use Illuminate\Http\Request;

class ActiveCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms', [
            'title'=>['ID Студента', 'ID дисциплины','Оценки'],
            'rows'=>ActiveCourse::all(),
            'names'=>['id_student','id_course','grade'],
            'linkURL'=>'activecourse'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        ActiveCourse::create([
            'id_student'=> $request['id_student'],
            'id_course'=> $request['id_course'],
            'grade'=> $request['grade']
        ]);
        return back();
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
     * @param  \App\Models\ActiveCourse  $activeCourse
     * @return \Illuminate\Http\Response
     */
    public function show(ActiveCourse $activeCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActiveCourse  $activeCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(ActiveCourse $activeCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ActiveCourse  $activeCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActiveCourse $activeCourse)
    {
        return ActiveCourse::where('id',$request->id)->update([
            'id_student'=> $request->id_student,
            'id_course'=> $request->id_course,
            'grade'=> $request->grade
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActiveCourse  $activeCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ActiveCourse::where('id',$request->id)->delete();
    }
}
