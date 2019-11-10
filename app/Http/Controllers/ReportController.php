<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
use App\Teachers;
use App\Classes;
use App\Subjects;
use App\Values;
use App\ValuesDetails;
use App\subject_detail;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function LaporanNilaiSiswa()
    {
        $classes = Classes::all();
        return view('Report.laporanNilaiSiswa', ['classes' => $classes]);
    }
    public function LaporanNilaiSiswaKelas(Request $request, $classes_id)
    {
        $class_data = Classes::with('class_detail', 'class_detail.student', 'class_detail.student.users', 'class_detail.student.users.statuses')
        ->whereHas('class_detail', function ($query) {
            $query->whereHas('student', function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('status', '=', 'Aktif');
                });
            });
        })
        ->find($classes_id);
        $students = Students::find($request->students_id);
        $data_mapel = null;
        $arrayValue = array();
        $user = Auth::user();
        if ($students) {
            if($user->roles_id == 3){
                $data_mapel = subject_detail::with('subject', 'class', 'teacher')->where('classes_id', '=', $classes_id)->get();
            }else{
                $teacher = Teachers::find($user->userstable_id);
                $data_mapel = subject_detail::with('subject', 'class', 'teacher')->where('classes_id', '=', $classes_id)
                ->where('teachers_id', '=', $teacher->id)
                ->get();
            }
            foreach ($data_mapel as $mapel) {
                $data_value = Values::with([
                    'type',
                    'subject_detail',
                    'subject_detail.subject',
                    'subject_detail.teacher',
                    'subject_detail.class',
                    'value_detail' => function ($q) use ($students) {
                        $q->where('students_id', '=', $students->id);
                    }
                ])
                ->where('subjects_details_id', '=', $mapel->id)
                ->get();
                array_push($arrayValue, $data_value);
            }
        }
        // dd($arrayValue);
        // $values = Values::distinct()->get(['basic_cur']);
        return view('Report.LaporanNilaiSiswaKelas', [
            'classes' => $class_data,
            // 'values' => $values,
            'students' => $students,
            'data_subject' => $data_mapel,
            'arrayValue' => $arrayValue,
        ]);
    }
    public function LaporanNilaiMataPelajaran()
    {
        $classes = Classes::all();
        return view('Report.laporanNilaiMataPelajaran', ['classes'=> $classes]);
    }
    public function LaporanNilaiMataPelajaranKelas(Request $request, $id)
    {
        $classes = Classes::find($id);
        $user = Auth::user();
        if ($user->roles_id == 3) {
            $subject_data = subject_detail::with('subject')->where('classes_id','=',$classes->id)->get();
        }else{
            $teacher = Teachers::find($user->userstable_id);
            $Subject_detail = $subject_data = subject_detail::with('subject')
            ->where('teachers_id', '=', $teacher->id)
            ->where('classes_id','=',$classes->id)
            ->get();
        }
        
        $subjects_details = subject_detail::with('subject')->find($request->filter);
        $teachers = null;
        $value = null;
        // dd($subjects_details);
        if($subjects_details){
            $teachers = Teachers::find($subjects_details->teachers_id);
            $value = Values::with('type', 'value_detail', 'value_detail.student')->where('subjects_details_id','=',$subjects_details->id)->get();
            // dd($value[0]->value_detail);
        }
        
        // dd($teachers, $value, $request);
        return view('Report.laporanNilaiMataPelajaranKelas',[
            'classes' => $classes,
            'subject_data' => $subject_data,
            'teacher' => $teachers,
            'subject_detail' => $subjects_details,
            'values' => $value,
        ]);
    }
}
