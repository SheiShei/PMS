<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['task_id', 'user_id', 'text', 'original_filename', 'new_filename', 'extension'];

    public function task() {
        return $this->belongsTo('App\Task');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
