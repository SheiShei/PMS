<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BRole extends Model
{
    protected $fillable = ['name', 'board_id'];

    public function board() {
        return $this->belongsTo('App\Board');
    }

    public function permissions() {
        return $this->belongsToMany('App\BPermission', 'role_permissions', 'role_id', 'permission_id');
    }

    public function roleuser() {
        return $this->hasMany('App\BoardUser','bRole_id');
    }
}
