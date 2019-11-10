<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
use App\Teachers;
use App\Departments;
use App\Subjects;
use App\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(){
        $auth = Auth::user();
        if($auth->rolse_id != 1){
            $students = Students::with('departments','users','users.roles','users.statuses')
            ->whereHas('users',function($query){
                    $query->whereHas('statuses',function($query){
                        $query->where('status','=','Aktif');
                    });
                }
            )->count();
            $teachers = Teachers::with('users','users.roles','users.statuses')
                ->whereHas('users',function($query){
                    $query->whereHas('statuses',function($query){
                        $query->where('status','=','Aktif');
                    });
                }
            )->count();
            $departments = Departments::where('status','=','Aktif')->count();
            $subjects = Subjects::where('status','=','Aktif')->count();
            $array = [
                'students'=>$students,
                'teachers'=>$teachers,
                'departments'=>$departments,
                'subjects'=>$subjects,
            ];
            
            return view('index',[
                'request'=>$array,
                'auth'=>$auth,
            ]);
        }
    }
    public function edit(){
        $auth = Auth::user();
        return view('profil',['auth'=>$auth]);
    }
    public function changePassword(Request $request){
        $validateData = $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'conf_pass' => 'required',
        ]);
        $user = Users::find($request->user_id);

        if(!Hash::check($validateData['old_pass'], $user->password)){
            return redirect()->back()->with('error','Kata Sandi lama Tidak Sama.');
        }
        if($validateData['new_pass'] != $validateData['conf_pass']){
            return redirect()->back()->with('error','Kata Sandi dan konfirmasi kata sandi Tidak Sama.');
        }
        $password = Hash::make($validateData['new_pass'],['rounds' => 12]);
        $user->password = $password;
        $user->update();
        return redirect()->back()->with('success','Kata Sandi berhasil diubah.');

    }
}
