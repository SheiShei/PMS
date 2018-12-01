<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Message extends Model
{
    use Uuids;
    public $incrementing = false;
    
    protected $fillable = ['text', 'action', 'original_filename', 'new_filename', 'extension', 'conversation_id', 'sender_id', 'receiver_id', 'seen', 'read'];

    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo('App\User', 'receiver_id');
    }

    public function convo() {
        return $this->belongsTo('App\Conversation');
    }

    public function getNewFilenameAttribute($file) {
        if($file) {
            return '/storage/messages/' . $file;
        }
        return null;
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('h:i a');
    }

}
