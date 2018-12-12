<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['name', 'type', 'created_by'];

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function sprints() {
        return $this->hasMany('App\Sprint');
    }

    public function cards() {
        return $this->hasMany('App\Card');
    }
}
