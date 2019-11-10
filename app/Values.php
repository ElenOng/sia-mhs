<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
    protected $table = 'values';
    protected $primarykey = 'id';
    protected $fillable = [
        'subjects_details_id','value_desc','basic_cur','weight', 'types_id',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function subject_detail()
    {
        return $this->belongsTo('App\subject_detail', 'subjects_details_id');
    }
    public function value_detail()
    {
        return $this->hasMany('App\ValuesDetails', 'values_id');
    }
    public function type()
    {
        return $this->belongsTo('App\types', 'types_id');
    }
}
