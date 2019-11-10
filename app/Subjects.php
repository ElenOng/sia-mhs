<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    protected $table = 'subjects';
    protected $primarykey = 'id';
    protected $fillable = [
        'subject_name','alias','subject_type','min_value','departments_id','status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
    
    public function department()
    {
        return $this->belongsTo('App\Departments', 'departments_id');
    }
    public function subject_detail()
    {
        return $this->hasMany('App\Subject_detail', 'subjects_id');
    }
}
