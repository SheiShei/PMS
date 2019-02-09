<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStory extends Model
{
    protected $fillable = ['sprint_id', 'name', 'description', 'created_by', 'points', 'order'];

    public function sprint() {
        return $this->belongsTo('App\Sprint');
    }

    public function tasks() {
        return $this->hasMany('App\Task', 'us_id');
    }
}
