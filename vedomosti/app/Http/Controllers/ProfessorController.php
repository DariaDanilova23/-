<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professors', [
            'title'=>['ФИО профессора', 'Адрес','Телефон','Оклад'],
            'rows'=>Professor::all(),
            'names'=>['FIO','Address','PhoneNo','Salary'],
            'linkURL'=>'professor'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Professor::create([
            'FIO' => $request['FIO'],
            'Address' => $request['Address'],
            'PhoneNo' => $request['PhoneNo'],
            'Salary'=>$request['Salary']
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        return Professor::where('id',$request->id)->update([
            'FIO' => $request->FIO,
            'Address' => $request->Address,
            'PhoneNo' => $request->PhoneNo,
            'Salary'=>$request->Salary
        ]);
        return response()->json();
    }
    public function remove(Request $request)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Professor::where('id',$request->id)->delete();
    }
}
