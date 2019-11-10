<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Departments;
use App\Teachers;
use Illuminate\Support\Collection;
use App\class_details;
class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = Classes::with('class_detail')->get();
        return view('classes.index',['request'=>$classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Departments::where('status','=','Aktif')->get();
        $teachers = Teachers::with('users','users.roles','users.statuses')
            ->whereHas('users',function($query){
                $query->whereHas('statuses',function($query){
                    $query->where('status','=','Aktif');
                });
            }
        )->get();
        return view('classes.create',[
            'request'=>$departments,
            'teachers' =>$teachers,
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
            'class_number' => 'required',
            'grade' => 'required',
            'yearA' => 'required',
            'semester' => 'required',
            'departments_id' => 'required',
            'teachers_id' => 'required',

        ]);
        $departments = Departments::find($request->departments_id);
        $class_name = $request->grade . ' ' . $departments->prefix . ' ' . $request->class_number;
        $school_year = $request->yearA.'/'.$request->yearB;

        $validity = Classes::where('class_name','=',$class_name)->where('school_year','=',$school_year)->where('semester','=',$request->semester)->where('departments_id','=',$request->departments_id)->count();
        if ($validity > 0) {
            // dd($validity);
            return redirect('classes/create')->with('status', 'Kelas sudah ada, silahkan masukkan data yang berbeda');
        }

        $validity = Classes::where('school_year','=',$school_year)->where('semester','=',$validateData['semester'])->where('teachers_id','=',$validateData['teachers_id'])->count();
        // dd($validity);
        if ($validity > 0) {
            // dd($validity);
            return redirect('classes/create')->with('status', 'Wali Kelas sudah berada pada kelas yang lain, silahkan masukkan wali kelas yang berbeda');
        }

        // dd($validateData['teachers_id']);
        $classes = Classes::create([
            'class_name' => $class_name,
            'grade' => $validateData['grade'],
            'semester' => $validateData['semester'],
            'school_year' => $school_year,
            'departments_id' => $validateData['departments_id'],
            'teachers_id' => $validateData['teachers_id'],
            'status' => 'Aktif',
        ]);
        return redirect('/classes')->with('success','Data Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classes = Classes::find($id)->first();
        // dd($classes);
        return view('classes.detail', ['request' => $classes]);
    }
    public function deactive($id)
    {
        $classes = Classes::find($id);
        $classes->status = 'Tidak Aktif';
        $classes->save();
        return redirect()->back();
    }
}
