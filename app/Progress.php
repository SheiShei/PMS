<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = ['remaining_points', 'board_id', 'sprint_id'];

    public function board() {
        return $this->belongsTo('App\Board');
    }

    public function sprint() {
        return $this->belongsTo('App\Sprint');
    }
}
