<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Statuses;
use App\Roles;
use App\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $request = Teachers::all();
        $request = Teachers::with('users','users.roles','users.statuses')->get();
        // dd($request);
        return view('teachers.index',['request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
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
            'employee_number' => 'required|unique:teachers,employee_number',
            'teacher_name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'degree' => 'required',
        ]);
        $roles = Roles::where('role', 'Guru')->first();
        $statuses = Statuses::where('detail', 'Aktif')->first();
        if($statuses == null){
            $data = [
                'detail' => 'Aktif',
                'status' => 'Aktif',
            ];
            $statuses = Statuses::create($data);
            // dd($data);
            $statuses = Statuses::where('detail', 'Aktif')->first();
        }
        $birth_date = $validateData['birth_date'];
        $password = Hash::make($validateData['birth_date'],['rounds' => 12]);
        $teachers = Teachers::create([
            'employee_number' => $validateData['employee_number'],
            'teacher_name' => $validateData['teacher_name'],
            'gender' => $validateData['gender'],
            'birth_date' => $validateData['birth_date'],
            'degree' => $validateData['degree'],
            'status' => 'Aktif',
        ]);
        $users = new Users;
        // dd($statuses);
        $users->fill([
            'userstable_id' => $teachers->id,
            'userstable_type' => 'App\Teachers',
            'username' => $validateData['employee_number'],
            'roles_id' => $roles->id,
            'password' => $password,
            'statuses_id'=> $statuses['id'],
        ]);
        $users->save();
        return redirect('/teachers')->with('success','Data Guru berhasil ditambahkan');
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
        $request = Teachers::with('users','users.roles','users.statuses')->where('teachers.id','=',$id)->first();
        $statuses = Statuses::all();
        return view('teachers.edit',[
            'request'=>$request,
            'status'=>$statuses,
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
        $teachers = Teachers::find($id);
        $users = Users::where([
            'userstable_id'=>$teachers->id,
            'username'=>$teachers->employee_number,
        ])->first();
        if($teachers->employee_number != $request->employee_number){
            $validateData = $request->validate([
                'employee_number' => 'required|unique:teachers,employee_number',
                'teacher_name' => 'required',
                'gender' => 'required',
                'birth_date' => 'required',
                'degree' => 'required',
                'statuses_id' => 'required',
            ]);
            $users->username = $validateData['employee_number'];
            $users->statuses_id = $validateData['statuses_id'];
            $users->update();
        }else{
            $validateData = $request->validate([
                'employee_number' => 'required',
                'teacher_name' => 'required',
                'gender' => 'required',
                'birth_date' => 'required',
                'degree' => 'required',
                'statuses_id' => 'required',
            ]);
            $users->statuses_id = $validateData['statuses_id'];
            $users->update();
        }
        $status = Statuses::find($validateData['statuses_id']);
        $teachers->status = $status->status;
        $teachers->update($validateData);
        return redirect('/teachers')->with('success','Data Guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        $teachers = Teachers::find($id);
        $statuses = Statuses::where('detail','=','Tidak Aktif')->first();
        if($statuses == null){
            Statuses::create([
                'status' => 'Tidak Aktif',
                'detail' => 'Tidak Aktif',
            ]);
            $statuses = Statuses::where('detail','=','Tidak Aktif')->first();
        }
        $users = Users::with('statuses')->where([
            'userstable_id'=>$teachers->id,
            'username'=>$teachers->employee_number,
        ])->first();
        $teachers->status = 'Tidak Aktif';
        $users->statuses_id = $statuses->id;
        $teachers->update();
        $users->update();
        return redirect()->back();
    }
}
