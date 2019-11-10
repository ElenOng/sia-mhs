<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $table = 'teachers';
    protected $primarykey = 'id';
    protected $fillable = [
        'employee_number', 'teacher_name','birth_date','gender','degree','status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
    public function users()
    {
        return $this->morphMany('App\Users', 'userstable');
    }
}
