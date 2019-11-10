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
use PDF;

class Downloads extends Controller
{
    public function downloadStudents($students_id, $classes_id, $subjects_id, $types_id)
    {
        if ($types_id == 2) {
            $type = "Nilai Pengetahuan";
        } else {
            $type = "Nilai Keterampilan";
        }
        $class_data = Classes::with('class_detail', 'class_detail.student', 'class_detail.student.users', 'class_detail.student.users.statuses')
            ->whereHas('class_detail', function ($query) {
                $query->whereHas('student', function ($query) {
                    $query->whereHas('users', function ($query) {
                        $query->where('status', '=', 'Aktif');
                    });
                });
            })
            ->find($classes_id);

        $students = Students::find($students_id);
        $data_mapel = null;
        $arrayValue = array();
        $arrayGrandTotal = array();
        $grand_score = 0;
        $title = null;
        $basic_cur = null;

        if ($students) {
            $data_mapel = subject_detail::with('subject', 'class', 'teacher')->where('classes_id', '=', $classes_id)->where('subjects_id', '=', $subjects_id)->get();
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
                    ->where('types_id', '=', $types_id)->where('subjects_details_id', '=', $mapel->id)
                    ->get();
                if ($data_value->count() > 1) {
                    $basic_cur = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $mapel->id)->distinct()->get(['basic_cur']);
                    $title = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $mapel->id)->where('basic_cur', '=', $basic_cur->first()->basic_cur)->get();
                }

                // dd($title);
                array_push($arrayValue, $data_value);
            }
        }
        $title_data = collect([
            'basic_cur' => 'Kurikulum Dasar',
            'grand_total' => 'Total Akhir',
            'content' => collect([]),
        ]);
        $title->each(function($item) use (&$title_data){
            $value = collect([
                'title' => $item->value_desc,
                'weight' => 'Bobot',
                'total' => 'Total',
            ]);
            
            
            $title_data['content']->push($value);
        });
        // dd($title_data);
        $data = collect([]);
        $basic_cur->each(function ($item) use (&$data, $arrayValue) {
            $temp = $arrayValue[0]->filter(function ($value) use ($item) {
                return $value->basic_cur == $item->basic_cur;
            });
            $total = $temp->sum(function($item) {
                return $item->value_detail[0]->total;
            });
            $weight = $temp->sum(function($item){
                return $item->weight;
            });
            $grand_total = $total / $weight;
            $value = collect([
                'name' => $item->basic_cur,
                'details' => collect([]),
                'grand' => $grand_total,
            ]);
            $temp->each(function ($item) use (&$value) {
                $value['details']->push(collect([
                    'name' => $item->value_desc,
                    'weight' => $item->weight,
                    'value' => $item->value_detail[0]->value,
                    'total' => $item->value_detail[0]->total,
                ]));
            });

            $data->push($value);
        });
        $count = 0;
        foreach ($data as $key => $value) {
            $count+= $value['grand'];
            $index = $key;
        }
        $index = $index +1;
        $count = $count / $index;
        // dd($count);
        return view('downloads.LaporanSiswaMataPelajaranKelas', [
            'classes' => $class_data,
            'types_id' => $types_id,
            'type' => $type,
            'students' => $students,
            'data_subject' => $data_mapel,
            'basic_cur' => $basic_cur,
            'grand_score' => $count,
            'title_data' => $title_data,
            'data' => $data,
        ]);
    }
    public function downloadStudents_pdf($students_id, $classes_id, $subjects_id, $types_id)
    {
        if ($types_id == 2) {
            $type = "Nilai Pengetahuan";
        } else {
            $type = "Nilai Keterampilan";
        }
        $class_data = Classes::with('class_detail', 'class_detail.student', 'class_detail.student.users', 'class_detail.student.users.statuses')
            ->whereHas('class_detail', function ($query) {
                $query->whereHas('student', function ($query) {
                    $query->whereHas('users', function ($query) {
                        $query->where('status', '=', 'Aktif');
                    });
                });
            })
            ->find($classes_id);

        $students = Students::find($students_id);
        $data_mapel = null;
        $arrayValue = array();
        $title = null;
        $basic_cur = null;
        if ($students) {
            $data_mapel = subject_detail::with('subject', 'class', 'teacher')->where('classes_id', '=', $classes_id)->where('subjects_id', '=', $subjects_id)->get();
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
                    ->where('types_id', '=', $types_id)
                    ->where('subjects_details_id', '=', $mapel->id)
                    ->get();
                if ($data_value->count() > 1) {
                    $basic_cur = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $mapel->id)->distinct()->get(['basic_cur']);
                    $title = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $mapel->id)->where('basic_cur', '=', $basic_cur->first()->basic_cur)->get();
                }

                // dd($title);
                array_push($arrayValue, $data_value);
            }
            $title_data = collect([
                'basic_cur' => 'Kurikulum Dasar',
                'grand_total' => 'Total Akhir',
                'content' => collect([]),
            ]);
            $title->each(function($item) use (&$title_data){
                $value = collect([
                    'title' => $item->value_desc,
                    'weight' => 'Bobot',
                    'total' => 'Total',
                ]);
                $title_data['content']->push($value);
            });
            // dd($title_data);
            $data = collect([]);
            $basic_cur->each(function ($item) use (&$data, $arrayValue) {
                $temp = $arrayValue[0]->filter(function ($value) use ($item) {
                    return $value->basic_cur == $item->basic_cur;
                });
                $total = $temp->sum(function($item) {
                    return $item->value_detail[0]->total;
                });
                $weight = $temp->sum(function($item){
                    return $item->weight;
                });
                $grand_total = $total / $weight;
                $value = collect([
                    'name' => $item->basic_cur,
                    'details' => collect([]),
                    'grand' => $grand_total,
                ]);
                $temp->each(function ($item) use (&$value) {
                    $value['details']->push(collect([
                        'name' => $item->value_desc,
                        'weight' => $item->weight,
                        'value' => $item->value_detail[0]->value,
                        'total' => $item->value_detail[0]->total,
                    ]));
                });
    
                $data->push($value);
            });
            $count = 0;
            foreach ($data as $key => $value) {
                $count+= $value['grand'];
                $index = $key;
            }
            $index = $index +1;
            $count = $count / $index;
            // dd($count);
            // dd($arrayValue[0]);
        }
        $pdf = PDF::loadview(
            'downloads.LaporanSiswaMataPelajaranKelas_pdf',
            [
                'classes' => $class_data,
                'title' => $title,
                'types_id' => $types_id,
                'type' => $type,
                'students' => $students,
                'data_subject' => $data_mapel,
                'data_subject' => $data_mapel,
                'basic_cur' => $basic_cur,
                'grand_score' => $count,
                'title_data' => $title_data,
                'data' => $data,
            ]
        )->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Nilai Siswa ' . $students->name);
        // return $pdf->stream();
    }
    function downloadStudentsBack()
    {
        return redirect()->route('report-student');
    }
    function downloadSubjectsBack()
    {
        return redirect()->route('report-subject');
    }
    function downloadSubjects($subjects_id, $classes_id, $types_id)
    {
        if ($types_id == 2) {
            $type = "Nilai Pengetahuan";
        } else {
            $type = "Nilai Keterampilan";
        }
        $classes = Classes::find($classes_id);
        $subject_data = subject_detail::with('subject')
            ->where('subjects_id', '=', $subjects_id)
            ->where('classes_id', '=', $classes->id)
            ->get();
        $subjects_details = subject_detail::with('subject')->find($subjects_id);

        $teachers = null;
        $value = null;
        $title = null;
        $basic_cur = null;
        $students = null;
        // dd($subjects_details);
        if ($subjects_details) {
            $teachers = Teachers::find($subjects_details->teachers_id);
            $value = Values::with('type', 'value_detail', 'value_detail.student')->where('subjects_details_id', '=', $subjects_details->id)->where('types_id', '=', $types_id)->get();
            $array = array();
            $arrayStudents_id = array();
            foreach ($value as $val) {
                array_push($array, $val->id);
            }
            $value_data = ValuesDetails::with('student', 'valued')
                ->whereIn('values_id', $array)
                ->orderBy('students_id', 'asc')
                ->orderBy('values_id', 'asc')
                ->get();
            foreach ($value_data as $value) {
                if (!in_array($value->students_id, $arrayStudents_id))
                    array_push($arrayStudents_id, $value->students_id);
            }
            // dd($arrayStudents_id);
            
            // dd($value->count());
            if ($value->count() > 1) {
                $basic_cur = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $subject_data[0]->id)->distinct()->get(['basic_cur']);
                $title = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $subject_data[0]->id)->where('basic_cur', '=', $basic_cur->first()->basic_cur)->get();
                $students = Students::whereIn('id', $arrayStudents_id)->get();
            }
        }
        $title_data = null;
        $data = null;

        if($title != null){

            $title_data = collect([
                'basic_cur' => 'Kurikulum Dasar',
                'grand_total' => 'Total Akhir',
                'content' => collect([]),
            ]);
            $title->each(function($item) use (&$title_data){
                $value = collect([
                    'title' => $item->value_desc,
                    'weight' => 'Bobot',
                    'total' => 'Total',
                ]);
                $title_data['content']->push($value);
            });
            $data = collect([]);
            // dd($data);
            $students->each(function($item) use (&$data, $basic_cur, $value_data){
    
                $student_value = collect([
                    'id' => $item->id,
                    'name' => $item->name,
                    'value' => collect([]),
                    'grand' => 0,
                ]);
                $index = 0;
                $basic_cur->each(function($item) use (&$student_value, $value_data, &$index){
                    $temp = $value_data->filter(function($value) use ($student_value, $item){
                        return $value->valued->basic_cur == $item->basic_cur && $value->students_id == $student_value['id'];
                    });
                    // dd($temp);
                    $total = $temp->sum(function($item) {
                        return $item->total;
                    });
                    $weight = $temp->sum(function($item){
                        return $item->valued->weight;
                    });
                    $grand_total = $total / $weight;
                    $student_value['grand']+= $grand_total;
                    $val = collect([
                        'basic_cur' => $item->basic_cur,
                        'value_detail' => collect([]),
                        'grand_total' => $grand_total,
                    ]);
                    // dd($temp);
                    $temp->each(function($item) use (&$val){
                        // dd($item);
                        $val['value_detail']->push($item);
                    });
                    $index++;
                    $student_value['value']->push($val);
                });
                $student_value['grand'] = $student_value['grand'] / $index;
                $data->push($student_value);
            });
        }
        
        // dd($data);
        return view('downloads.LaporanMataPelajaran', [
            'classes' => $classes,
            'subjects' => $subject_data,
            'type' => $type,
            'titles' => $title,
            'title_data' => $title_data,
            'basic_cur' => $basic_cur,
            'value_data' => $value_data,
            'students' => $students,
            'types_id' => $types_id,
            'data' => $data,
        ]);
    }
    function downloadSubjects_pdf($subjects_id, $classes_id, $types_id)
    {
        if ($types_id == 2) {
            $type = "Nilai Pengetahuan";
        } else {
            $type = "Nilai Keterampilan";
        }
        $classes = Classes::find($classes_id);
        $subject_data = subject_detail::with('subject')->where('classes_id', '=', $classes->id)->get();
        $subjects_details = subject_detail::with('subject')->find($subjects_id);
        // dd($subjects_details);
        $teachers = null;
        $value = null;
        $title = null;
        $basic_cur = null;
        $students = null;
        // dd($subjects_details);
        if ($subjects_details) {
            $teachers = Teachers::find($subjects_details->teachers_id);
            $value = Values::with('type', 'value_detail', 'value_detail.student')->where('subjects_details_id', '=', $subjects_details->id)->where('types_id', '=', $types_id)->get();
            $array = array();
            $arrayStudents_id = array();
            foreach ($value as $val) {
                array_push($array, $val->id);
            }
            $value_data = ValuesDetails::with('student', 'valued')
                ->whereIn('values_id', $array)
                ->orderBy('students_id', 'asc')
                ->orderBy('values_id', 'asc')
                ->get();
            foreach ($value_data as $value) {
                if (!in_array($value->students_id, $arrayStudents_id))
                    array_push($arrayStudents_id, $value->students_id);
            }
            // dd($arrayStudents_id);
            if ($value->count() > 1) {
                $basic_cur = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $subject_data[0]->id)->distinct()->get(['basic_cur']);
                $title = Values::where('types_id', '=', $types_id)->where('subjects_details_id', '=', $subject_data[0]->id)->where('basic_cur', '=', $basic_cur->first()->basic_cur)->get();
                $students = Students::whereIn('id', $arrayStudents_id)->get();
            }
        }
        $pdf = PDF::loadview(
            'downloads.LaporanMataPelajaran_pdf',
            [
                'classes' => $classes,
                'subjects' => $subject_data,
                'type' => $type,
                'titles' => $title,
                'basic_cur' => $basic_cur,
                'value_data' => $value_data,
                'students' => $students,
                'types_id' => $types_id,
            ]
        )->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Nilai ' . $subject_data[0]->subject->subject_name . ' Kelas ' . $classes->class_name);
    }
}
