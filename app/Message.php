<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function getNewFilenameAttribute($file) {
        if($file) {
            return '/storage/messages/' . $file;
        }
        return null;
    }

}
