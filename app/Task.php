<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Uuids;
    
    public $incrementing = false;
    
    protected $fillable = ['card_id', 'task_cover', 'jo_id', 'order', 'due', 'points', 'name', 'description', 'created_by', 'assigned_to', 'assigned_by'];

    public function joborder() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }

    public function card() {
        return $this->belongsTo('App\Card');
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function assigned_by() {
        return $this->belongsTo('App\User', 'assigned_by');
    }

    public function assigned_to() {
        return $this->belongsTo('App\User', 'assigned_to');
    }

    public function files() {
        return $this->hasMany('App\TaskFile');
    }
}
