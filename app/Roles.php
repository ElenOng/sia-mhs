<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $primarykey = 'id';
    protected $fillable = [
        'role','status',
    ];
    protected $keytype = 'BigIncrements';
    public $incrementing = true;
    public $timestamps = true;
    public function users()
    {
        return $this->hasMany('App\Users', 'roles_id');
    }
}
