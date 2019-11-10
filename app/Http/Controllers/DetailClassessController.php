<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Students;
use App\class_details;
use Illuminate\Support\Facades\Redirect;

class DetailClassessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Classes::with('class_detail', 'class_detail.student')
            ->find($id);
        // dd($response);
        return view('classes.detail', ['request' => $response]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $classes = Classes::find($id);
        $response = Students::with('departments')->where('departments_id','=',$classes->departments_id)->has('class_details', '=', 0)->get();
        $response2 = Students::with('departments')->where('departments_id','=',$classes->departments_id)->whereHas('class_details', function ($query) use ($classes) {
            $query->whereHas(
                'classes',
                function ($query) use ($classes) {
                    $query
                        ->where('semester', '!=', $classes->semester)
                        ->orWhere('school_year', '!=', $classes->school_year);
                }
            );  
        })->get();
        $merged = $response->merge($response2);
        // dd($merged);
        return view('classes.add_students',['request'=>$merged, 'id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->students_id);
        if($request->students == null){
            return redirect()->back()->with('errors','Pilihlah data siswa yang yang mau dimasukkan!!!');
        }
        foreach($request->students as $student_id){
            class_details::create([
                'classes_id' => $request->id,
                'students_id' => $student_id,
            ]);
        }
        return redirect('/classes/detail/'.$request->id);
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
        $class_det = class_details::find($id);
        $class_det->delete();
        return redirect()->back();
    }
}
