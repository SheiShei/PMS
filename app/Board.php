<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Board extends Model
{
    use Uuids, Notifiable;
    
    public $incrementing = false;
    
    protected $fillable = ['name', 'description', 'type', 'created_by', 'privacy', 'board_image'];

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
        return $this->belongsToMany('App\User')->withPivot('added_by', 'bRole_id', 'isAdmin')->withTimestamps();
    }

    public function bu() {
        return $this->belongsToMany('App\User')->using('App\BoardUser')->withPivot('added_by', 'bRole_id', 'isAdmin');
    }

    public function roles() {
        return $this->hasMany('App\BRole');
    }

    public function getBoardImageAttribute($image) {
        if($image) {
            return '/storage/boards/' . $image;
        }
        return null;
    }
}
