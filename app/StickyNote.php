<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StickyNote extends Model
{
    protected $fillable = ['title', 'content', 'order', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
