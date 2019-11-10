<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\subject_detail;
use App\Values;
use App\types;
use App\Teachers;
use App\Students;
use App\Subjects;
use App\Classes;
use App\ValuesDetails;



class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if(Auth::user()->roles_id == 3){
            $response = subject_detail::with('class', 'teacher','subject')->get();
        }
        else{
            $teacher = Teachers::find(Auth::user()->userstable_id);
            $response = subject_detail::with('class', 'teacher','subject')
            ->where('teachers_id', '=', $teacher->id)
            ->get();
        }
        // dd($response);
        return view('scores.index', ['response'=>$response, 'type'=>$type]);
    }

    public function detail($type, $id){
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        $response = subject_detail::with('class', 'teacher','subject')->find($id);
        $values = Values::with('subject_detail', 'subject_detail.class','subject_detail.teacher','subject_detail.subject')->where('types_id','=',$types_id)->where('subjects_details_id','=',$id)->distinct()->get(['basic_cur']);
        // dd($values);
        // dd($response);
        return view('scores.detail',[
            'type' => $type,
            'data' => $response,
            'response'=>$values,
        ]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create($type, $id)
    {
        return view('scores.create',[
            'type' => $type,
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        $subject_details = subject_detail::find($request->subjects_details_id);
        $class = Classes::with('class_detail', 'class_detail.student')
            ->find($subject_details->classes_id);
        $subject = Subjects::find($subject_details->subjects_id);
        $teacher = Teachers::find($subject_details->teachers_id);
        // dd($teacher);
        $validity = Values::with('subject_detail')
        ->whereHas('subject_detail', function($query) use ($class, $subject, $teacher){
            $query
            ->where('classes_id','=',$class->id)
            ->where('subjects_id','=',$subject->id)
            ->where('teachers_id','=', $teacher->id);
            
        })
        ->where('basic_cur', $request->basic_cur)->where('types_id','=',$types_id)->get();
        // dd($validity);
        if(count($validity) > 0){
            return redirect()->back()->with('valid','Kurikulum dasar sudah ada silahkan pilih kurikulum dasar lain');
        }
        // $validity = Values::where('basic_cur','=',$request->basic_cur)->where('value_desc','')->get();
        $validateData = $request->validate([
            'basic_cur' => 'required',
        ]);
        if($types_id == 2)
        {
            $dataValues = [
                [
                    'Penugasan', 1
                ],
                [
                    'Penilaian Harian', 1
                ],
                [
                    'UTS', 2
                ],
                [
                    'UAS', 2
                ],
            ];
        }
        else{
            $dataValues = [
                [
                    'Proses', 1
                ],
                [
                    'Produk', 1
                ],
                [
                    'Proyek', 2
                ],
            ];
        }
        // dd($dataValues);
        foreach ($dataValues as $vals) {
            // dd($vals);
            $values = Values::create([
                'subjects_details_id' => $request->subjects_details_id,
                'value_desc' => $vals[0],
                'basic_cur' => $validateData['basic_cur'],
                'weight' => $vals[1],
                'types_id' => $types_id,
            ]);
            // dd($class->class_detail);
            foreach ($class->class_detail as $count) {
                ValuesDetails::create([
                    'values_id' => $values->id,
                    'students_id' => $count->student->id,
                    'value' => 0,
                    'average' => 0,
                    'total' => 0,
                ]);
            }
        }
        // dd($request->subjects_details_id);
        return redirect()->route('score-detail', [$type, $request->subjects_details_id]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $id, $find)
    {
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        $value = Values::where('basic_cur','=',$find)->where('types_id','=', $types_id)->get();
        
        return view('scores.edit',[
            'response'=> $value,
            'type' => $type,
            'id' => $id,
            'find' => $find,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $find)
    {
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        // dd($request);
        $values = Values::where('basic_cur','=',$find)->get();
        // dd($values);
        foreach ($request->weight as $key => $val) {
            $values[$key]->weight = $val;
            $values[$key]->save();
            $valuesDetails = ValuesDetails::where('values_id','=', $values[$key]->id)->get();
            foreach($valuesDetails as $value){
                $value->total = $value->value * $val;
                $value->update();
            }
        }

        return redirect()->route('score-detail', [$type, $request->identity]);
    }

    public function list($type, $id, $find){
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        $data = Values::where('basic_cur','=',$find)->where('types_id','=',$types_id)->where('subjects_details_id', '=', $id)->get();
        // dd($id);
        $item = array();
        foreach ($data as $dat) {
            array_push($item, $dat->id);
        }
        // dd($response);
        return view('scores.detail_score',[
            'data'=>$data,
            'type'=>$type,
            'id'=>$id,
            'find'=>$find,
        ]);
    }
    public function edit_score($type, $id, $find, $values_id)
    {
        // dd($id);
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        $value_data = Values::find($values_id);
        // dd($value_data);
        $student_data = ValuesDetails::with('valued','student')
        ->where('values_id','=',$values_id)->get();
        return view('scores.edit_score',[
            'data'=>$value_data,
            'response'=>$student_data,
            'type'=>$type,
            'id'=>$id,
            'find'=>$find,
            'values_id'=>$values_id,
        ]);
    }

    public function edit_score_list($type, $id, $find, $values_id)
    {
        if($type == 'knowledge'){
            $types_id = 2;
        }else{
            $types_id = 1;
        }
        // dd($value_data);
        $student_data = ValuesDetails::with('valued','student')
        ->where('values_id','=',$values_id)->get();
        return view('scores.update_score',[
            'type'=>$type,
            'response'=>$student_data,
            'id'=>$id,
            'find'=>$find,
            'values_id' => $values_id,
        ]);
    }

    public function update_score(Request $request, $type, $id, $find, $values_id)
    {
        $ids = $request->input('id');
        $value = $request->input('value');
        $valuesDetails = ValuesDetails::find($ids);
        $data = Values::find($values_id);
        foreach ($valuesDetails as $index=>$val) {
            $val->value = $value[$index];
            $val->average = $value[$index] / 1;
            $val->total = $value[$index] * $data->weight;
            $val->save();
        }
        
        // dd($type, $id, $find);
        return redirect()->route('score-list-edit', [$type, $id, $find, $values_id]);
    }
}
