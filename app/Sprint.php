<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use Uuids;

    public $incrementing = false;
    
    protected $fillable = ['name', 'created_by', 'due_date', 'board_id', 'started_at', 'finished_at', 'type'];

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function board() {
        return $this->belongsTo('App\Board');
    }

    public function cards() {
        return $this->hasMany('App\Card');
    }

    public function tasks() {
        return $this->hasMany('App\Task');
    }
}
