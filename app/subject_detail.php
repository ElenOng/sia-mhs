<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject_detail extends Model
{
    protected $table = 'subject_details';
    protected $primarykey = 'id';
    protected $fillable = [
        'subjects_id','teachers_id','classes_id',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function class()
    {
        return $this->belongsTo('App\Classes', 'classes_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Teachers', 'teachers_id');
    }
    public function subject()
    {
        return $this->belongsTo('App\Subjects', 'subjects_id');
    }
}
