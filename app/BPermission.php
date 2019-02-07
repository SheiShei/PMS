<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BPermission extends Model
{
    protected $fillable = ['name', 'type'];

    public function roles() {
        return $this->belongsToMany('App\BRole', 'role_permissions', 'permission_id', 'role_id');
    }
}
