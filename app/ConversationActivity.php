<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationActivity extends Model
{
    protected $fillable = ['conversation_id', 'main', 'support', 'action'];

    public function conversation() {
        return $this->belongsTo('App\Conversation');
    }

    public function main() {
        return $this->belongsTo('App\User', 'main');
    }

    public function support() {
        return $this->belongsTo('App\User', 'support');
    }
}
