<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = 'departments';
    protected $primarykey = 'id';
    protected $fillable = [
        'prefix', 'department_name','status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
    public function students()
    {
        return $this->hasMany('App\Students', 'departments_id');
    }
}
