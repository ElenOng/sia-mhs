<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'users';
    protected $primarykey = null;
    protected $fillable = [
        'userstable_id','userstable_type','username','roles_id','password','statuses_id',
    ];
    protected $hidden = [
        'password',
    ];
    public $incrementing = false;
    public $timestamps = true;

    public function roles()
    {
        return $this->belongsTo('App\Roles', 'roles_id');
    }
    public function statuses()
    {
        return $this->belongsTo('App\Statuses', 'statuses_id');
    }
    public function userstable()
    {
        return $this->morphTo();
    }
}
