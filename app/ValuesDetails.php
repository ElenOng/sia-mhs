<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValuesDetails extends Model
{
    protected $table = 'values_details';
    protected $primarykey = 'id';
    protected $fillable = [
        'values_id', 'students_id', 'value', 'average', 'total',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
    public function valued()
    {
        return $this->belongsTo('App\Values', 'values_id');
    }
    public function student()
    {
        return $this->belongsTo('App\Students', 'students_id');
    }

}
