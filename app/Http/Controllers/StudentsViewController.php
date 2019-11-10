<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Students;
use App\Classes;
use App\Departments;
use App\Values;
use App\Subjects;
use App\subject_detail;
use App\Teachers;
use App\Users;

use Illuminate\Support\Facades\Hash;
class StudentsViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = Auth::user();
        $student = Students::find((int)$user->userstable_id);
        $classes = Classes::with('class_detail')
        ->whereHas('class_detail', function($query) use ($student){
            $query->where('students_id', '=', $student->id);
        })
        ->get();
        // dd($classes);
        return view('students_view.index',[
            'student' => $student,
            'classes' => $classes,
        ]);
    }
    public function profile($students_id){
        $students = Students::with('departments','users','users.roles','users.statuses')->where('id',$students_id)->get();
        return view('students_view.profile', ['request' => $students]);
    }
    public function edit($students_id){
        $students = Students::with('departments')->find($students_id);
        $departments = Departments::all();
        // dd($students);
        return view('students_view.edit_profile', [
            'request' => $students,
            'departments' => $departments
        ]);
    }
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
        return redirect()->route('profile-student', $id)->with('success','Data Status berhasil diubah');
    }

    //yang ini yang masalah
    public function class_detail(Request $request, $students_id, $classes_id){
        $student = Students::find($students_id);
        $class = Classes::with('teacher')->find($classes_id);
        $subjects = subject_detail::with('subject')
        ->where('classes_id','=',$classes_id)
        ->get();
        
        $subject = $request->subjects_id;
        $values_knowledge = null;
        $values_skill = null;
        $basic_knowledge = null;
        $basic_skill = null;
        $title_knowledge = array();
        $title_skill = array();
        $title_knowledge = [
            'Penugasan', 'Penilaian Harian', 'UTS', 'UAS'
        ];
        $title_skill = [
            'Proses', 'Produk', 'Proyek'
        ];
        if($request->subjects_id) {
            $subject = subject_detail::with('subject')->where('subjects_id', '=', $request->subjects_id)->where('classes_id', '=', $classes_id)->get();
            // dd('masok');
            
            $values_knowledge = Values::with(['value_detail' => function($query) use ($students_id){
                $query->where('students_id', '=', $students_id);
            }])
            ->where('subjects_details_id', '=', $subject[0]->id)
            ->where('types_id', '=', 2)->get();
            // dd($values_knowledge);
            $basic_knowledge = Values::where('types_id','=', 2)->where('subjects_details_id','=',$subject[0]->id)->distinct()->get(['basic_cur']);
            // dd($basic_knowledge);
            $values_skill = Values::with(['value_detail' => function($query) use ($students_id){
                $query->where('students_id', '=', $students_id);
            }])
            ->where('subjects_details_id', '=', $subject[0]->id)
            ->where('types_id', '=', 1)->get();
            $basic_skill = Values::where('types_id','=', 1)->where('subjects_details_id','=',$subject[0]->id)->distinct()->get(['basic_cur']);
        }
        return view('students_view.class_detail',[
            'student' => $student,
            'class' => $class,
            'subjects' => $subjects,
            'subject' => $subject,
            'title_knowledge' => $title_knowledge,
            'title_skill' => $title_skill,
            'value_knowledge' => $values_knowledge,
            'value_skill' => $values_skill,
            'basic_knowledge' => $basic_knowledge,
            'basic_skill' => $basic_skill,
        ]);
    }
    public function changePassword($students_id){
        return view('students_view.edit_password', ['students_id' => $students_id]);
    }
    public function change_password(Request $request){
        $validateData = $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'conf_pass' => 'required',
            ]);
            $user = Users::where('userstable_id', '=', $request->students_id)->where('userstable_type', '=', 'App\Students')->get();
        if(!Hash::check($validateData['old_pass'], $user[0]->password)){
            return redirect()->back()->with('error','Kata Sandi lama Tidak Sama.');
        }
        if($validateData['new_pass'] != $validateData['conf_pass']){
            return redirect()->back()->with('error','Kata Sandi dan konfirmasi kata sandi Tidak Sama.');
        }
        $password = Hash::make($validateData['new_pass'],['rounds' => 12]);
        $user[0]->password = $password;
        $user[0]->update();
        return redirect()->back()->with('success','Kata Sandi berhasil diubah.');

    }
}
