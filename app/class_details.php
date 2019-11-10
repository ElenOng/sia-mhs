<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class class_details extends Model
{
    protected $table = 'class_details';
    protected $primarykey = 'id';
    protected $fillable = [
        'classes_id', 'students_id',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo('App\Students', 'students_id');
    }
    public function classes()
    {
        return $this->belongsTo('App\Classes', 'classes_id');
    }
}
