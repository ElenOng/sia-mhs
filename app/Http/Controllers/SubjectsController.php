<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Departments;
use App\Teachers;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subjects::all();
        // dd($subjects);
        return view('lessons.index',['request'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Departments::where('status','=','Aktif')->get();
        
        // dd($departments);
        return view('lessons.create',[
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'subject_name' => 'required',
            'alias' => 'required',
            'subject_type' => 'required',
            'min_value' => 'required',
            'departments_id' => 'required',
            'status' => 'required',
        ]);
        $validity = Subjects::where('alias','=',$validateData['alias'])->where('departments_id','=',$validateData['departments_id'])->get();
        if(count($validity)> 0){
            return redirect('/lessons/create')->with('validate','Data Mata Pelajaran pada jurusan tersebut sudah terdaftar.');
        }
        Subjects::create($validateData);
        return redirect('/lessons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subjects::with('department')->where('id','=',$id)->get();
        // dd($subject);
        return view('lessons.detail',['request' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subjects::find($id);
        $departments = Departments::where('status','=','Aktif')->get();
        return view('lessons.edit',[
            'request' => $subject,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'subject_name' => 'required',
            'alias' => 'required',
            'subject_type' => 'required',
            'min_value' => 'required',
            'departments_id' => 'required',
            'status' => 'required',
        ]);
        $subject = Subjects::find($id);
        $subject->subject_name = $validateData['subject_name'];
        $subject->alias = $validateData['alias'];
        $subject->subject_type = $validateData['subject_type'];
        $subject->min_value = $validateData['min_value'];
        $subject->departments_id = $validateData['departments_id'];
        $subject->status = $validateData['status'];
        $subject->update();

        return redirect('/lessons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subjects::find($id);
        $subject->status = 'Tidak Aktif';
        $subject->update();
        return redirect('/lessons');
    }
}
