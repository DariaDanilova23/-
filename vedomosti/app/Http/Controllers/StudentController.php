<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forms', [
            'title'=>['ФИО', 'Адрес', 'Номер телефона', 'email','Номер зачётки'],
            'rows'=>Student::all(),
            'names'=>['FIO','Address','PhoneNo','email','ReportCardNo'],
            'linkURL'=>'student'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Student::create([
            'FIO'=> $request['FIO'],
            'Address'=> $request['Address'],
            'PhoneNo'=> $request['PhoneNo'],
            'email'=> $request['email'],
            'ReportCardNo'=> $request['ReportCardNo']

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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        return Student::where('id',$request->id)->update([
            'FIO'=> $request->FIO,
            'Address'=> $request->Address,
            'PhoneNo'=> $request->PhoneNo,
            'email'=> $request->email,
            'ReportCardNo'=> $request->ReportCardNo
        ]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Student::where('id',$request->id)->delete();
    }
}
