<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    protected $table = 'statuses';
    protected $primarykey = 'id';
    protected $fillable = [
        'detail', 'status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
}
