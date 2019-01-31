<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    use Uuids, Notifiable;
    
    public $incrementing = false;
    
    protected $fillable = ['name', 'type', 'created_by', 'privacy'];

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function sprints() {
        return $this->hasMany('App\Sprint');
    }

    public function cards() {
        return $this->hasMany('App\Card');
    }

    public function boardUsers() {
        return $this->belongsToMany('App\User')->withPivot('added_by')->withTimestamps();
    }
}
