<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $primarykey = 'id';
    protected $fillable = [
        'student_number', 'name','gender','birth_date','birth_place','religion','address',
        'ex_school','ex_school_address','year_of_diploma','date_received','father_name',
        'mother_name','parents_phone','parents_address','guardian_name', 'guardian_address', 
        'guardian_phone','departments_id',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function departments()
    {
        return $this->belongsTo('App\Departments', 'departments_id');
    }
    public function users()
    {
        return $this->morphMany('App\Users', 'userstable');
    }
    public function class_details()
    {
        return $this->hasMany('App\class_details', 'students_id');
    }
    public function value_detail()
    {
        return $this->hasMany('App\ValuesDetails', 'students_id');
    }
}
