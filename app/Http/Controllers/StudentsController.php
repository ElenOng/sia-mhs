<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
use App\Departments;
use App\Users;
use App\Statuses;
use App\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Students::with('departments','users','users.roles','users.statuses')->get();
        return view('Students.index', ['request' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Departments::all();
        return view('Students.create',['request'=> $departments]);
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
            'student_number' => 'required|unique:students,student_number',
            'name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'ex_school' => 'required',
            'ex_school_address' => 'required',
            'date_received' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'parents_phone' => 'required',
            'parents_address' => 'required',
            'guardian_name' => 'required',
            'guardian_address' => 'required',
            'guardian_phone' => 'required',
            'departments_id' => 'required',
        ]);

        $roles = Roles::where('role', 'Siswa')->first();
        $statuses = Statuses::where('detail', 'Aktif')->first();
        if($statuses == null){
            $data = [
                'detail' => 'Aktif',
                'status' => 'Aktif',
            ];
            $statuses = Statuses::create($data);
            $statuses = Statuses::where('detail', 'Aktif')->first();
        }
        $birth_date = $validateData['birth_date'];
        $password = Hash::make($validateData['birth_date'],['rounds' => 12]);
        $student = Students::create([
            'student_number' => $validateData['student_number'],
            'name' => $validateData['name'],
            'gender' => $validateData['gender'],
            'birth_date' => $validateData['birth_date'],
            'birth_place' => $validateData['birth_place'],
            'religion' => $validateData['religion'],
            'address' => $validateData['address'],
            'ex_school' => $validateData['ex_school'],
            'ex_school_address' => $validateData['ex_school_address'],
            'date_received' => $validateData['date_received'],
            'father_name' => $validateData['father_name'],
            'mother_name' => $validateData['mother_name'],
            'parents_phone' => $validateData['parents_phone'],
            'parents_address' => $validateData['parents_address'],
            'guardian_name' => $validateData['guardian_name'],
            'guardian_address' => $validateData['guardian_address'],
            'guardian_phone' => $validateData['guardian_phone'],
            'departments_id' => $validateData['departments_id'],
        ]);
        $users = new Users();
        $users->fill([
            'userstable_id' => $student->id,
            'userstable_type' => 'App\Students',
            'username' => $validateData['student_number'],
            'roles_id' => 1,
            'password' => $password,
            'statuses_id'=> $statuses['id'],
        ]);
        $users->save();
        return redirect('/students')->with('success','Data Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Students::with('departments','users','users.roles','users.statuses')->where('id',$id)->get();
        return view('Students.detail', ['request' => $students]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Students::with('departments')->find($id);
        $departments = Departments::all();
        // dd($students);
        return view('Students.edit', [
            'request' => $students,
            'departments' => $departments
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
        $temp = Students::find($id);
        if($request->student_number != $temp->student_number)
        {
            $validateData = $request->validate([
                'student_number' => 'required|unique:students,student_number',
                'name' => 'required',
                'gender' => 'required',
                'birth_date' => 'required',
                'birth_place' => 'required',
                'religion' => 'required',
                'address' => 'required',
                'ex_school' => 'required',
                'ex_school_address' => 'required',
                'date_received' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'parents_phone' => 'required',
                'parents_address' => 'required',
                'guardian_name' => 'required',
                'guardian_address' => 'required',
                'guardian_phone' => 'required',
                'departments_id' => 'required',
            ]);
        }else{
            $validateData = $request->validate([
                'student_number' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'birth_date' => 'required',
                'birth_place' => 'required',
                'religion' => 'required',
                'address' => 'required',
                'ex_school' => 'required',
                'ex_school_address' => 'required',
                'date_received' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'parents_phone' => 'required',
                'parents_address' => 'required',
                'guardian_name' => 'required',
                'guardian_address' => 'required',
                'guardian_phone' => 'required',
                'departments_id' => 'required',
            ]);
        }
        if ($validateData['student_number']!= $temp->student_number) {
            $users = Users::where([
                'userstable_id' => $request->id,
                'username' => $temp['student_number'],
            ])->first();
            $users->update(['username' => $validateData['student_number']]);
        }
        $temp->update($validateData);
        return redirect('/students')->with('success','Data Status berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        if ($type == 'DO') {
            $students = Students::find($id);
            $users = Users::where([
                'userstable_id' => $students->id,
                'username' => $students->student_number,
            ])->first();
            $statuses = Statuses::where('detail','DO')->first();
            if($statuses == null){
                $statuses = Statuses::create([
                    'detail' => 'DO',
                    'status' => 'Tidak Aktif',
                ]);
            }
            $statuses = Statuses::where('detail','DO')->first();
            $users->statuses_id = $statuses->id;
            $users->update();
        }else{
            $students = Students::find($id);
            $users = Users::where([
                'userstable_id' => $students->id,
                'username' => $students->student_number,
            ])->first();
            $statuses = Statuses::where('detail','Lulus')->first();
            if($statuses == null){
                $statuses = Statuses::create([
                    'detail' => 'Lulus',
                    'status' => 'Tidak Aktif',
                ]);
            }
            $statuses = Statuses::where('detail','Lulus')->first();
            $users->statuses_id = $statuses->id;
            $users->update();
        }
        return redirect()->back();
    }
}
