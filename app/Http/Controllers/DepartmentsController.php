<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Departments::all();
        //filter
        // $departments = $departments->filter(function($value) use ($request) {
        //     $name = true;
        //     $prefix = true;
        //     $status = true;
        //     if (!empty($request->input('q'))) {
        //         if (!empty($value->department_name))
        //             $name = false !== stristr($value->department_name, $request->input('q'));
        //         if (!empty($value->prefix))
        //             $prefix  = false !== stristr($value->prefix, $request->input('q'));
        //         if (!empty($value->status))
        //         $status = false !== stristr($value->status, $request->input('q'));
        //     }
        //     return $name || $prefix || $status;
           
        // });
        // dd($departments);
        return view('departments.index',['request'=> $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
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
            'department_name' => 'required',
            'prefix' => 'required',
            'status' => 'required',
        ]);
        $departments = Departments::create($validateData);
        return redirect('/departments')->with('success','Data Jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Departments::findOrFail($id);
        return view('departments.edit', ['request'=> $departments]);
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
            'department_name' => 'required',
            'prefix' => 'required',
            'status' => 'required',
        ]);
        $department = Departments::find($id);
        $department->update($validateData);
        return redirect('/departments')->with('success','Data Jurusan berhasil diubah');
    }
    public function deactive($id){
        $departments = Departments::find($id);
        $departments->status = 'Tidak Aktif';
        $departments->save();
        return redirect('/departments')->with('success','Data Jurusan berhasil dinonaktifkan');
    }
}
