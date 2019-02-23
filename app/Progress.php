<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = ['remaining_points', 'jo_id', 'completed_tasks', 'board_id', 'sprint_id', 'todo', 'in_progress', 'for_test', 'closed'];

    public function board() {
        return $this->belongsTo('App\Board');
    }

    public function sprint() {
        return $this->belongsTo('App\Sprint');
    }

    public function jo() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }
}
