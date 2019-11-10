<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primarykey = 'id';
    protected $fillable = [
        'class_name', 'grade','semester','school_year','departments_id','teachers_id','status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function class_detail()
    {
        return $this->hasMany('App\class_details', 'classes_id');
    }
    public function subject_detail()
    {
        return $this->hasMany('App\Subject_detail', 'classes_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Teachers', 'teachers_id');
    }
}
