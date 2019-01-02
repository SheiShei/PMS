<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    protected $fillable = ['task_id', 'original_filename', 'new_filename', 'extension'];

    public function task() {
        return $this->belongsTo('App\Task');
    }
}
