<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = ['name', 'created_by', 'board_id'];

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function board() {
        return $this->belongsTo('App\Board');
    }

    public function cards() {
        return $this->hasMany('App\Card');
    }
}
