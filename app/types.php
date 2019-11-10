<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class types extends Model
{
    protected $table = 'types';
    protected $primarykey = 'id';
    protected $fillable = [
        'type',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;

    public function value()
    {
        return $this->hasMany('App\Values', 'types_id');
    }
}
