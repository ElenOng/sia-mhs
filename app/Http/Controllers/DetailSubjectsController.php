<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\Classes;
use App\Subjects;
use App\Teachers;
use App\subject_detail;
class DetailSubjectsController extends Controller
{
    public function index($id)
    {
        $classes = Classes::find($id);
        $subjects = Subjects::where('status','=','Aktif')->where('departments_id','=',$classes->departments_id)->get();
        $teachers = Teachers::with('users','users.roles','users.statuses')
            ->whereHas('users',function($query){
                $query->whereHas('statuses',function($query){
                    $query->where('status','=','Aktif');
                });
            }
        )->get();
        $response = subject_detail::with('class','teacher','subject')->where('classes_id','=',$classes->id)->get();

        return view('classes.add_subject',[
            'response'=>$response,
            'classes'=>$classes,
            'subjects'=>$subjects,
            'teachers'=>$teachers,

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
            'classes_id' => 'required',
            'teachers_id' => 'required',
            'subjects_id' => 'required',
        ]);
        $validity= subject_detail::where('classes_id','=',$validateData['classes_id'])
            ->where('subjects_id','=',$validateData['subjects_id'])
            ->get();
        if(count($validity)>0){
            return redirect('/classes/subject/'.$validateData['classes_id'])->with('invalids','Mata Pelajaran sudah terdaftar dalam kelas');
        }
        $sub_class = subject_detail::create($validateData);
        return redirect('/classes/subject/'.$validateData['classes_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $subclass = subject_detail::find($id);
        $subclass->delete();
        return redirect()->back();
    }
}
