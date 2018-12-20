<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JoCreative extends Model
{
    protected $fillable = ['ad_type', 'post_caption', 'media', 'file_type', 'jo_id', 'copy', 'status', 'revisions', 'completed_at', 'signed_by'];

    public function joborder() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }

    public function signedby() {
        return $this->belongsTo('App\User', 'signed_by');
    }
    
    public function getCompletedAtAttribute($date) {
        if($date) {
            return Carbon::parse($date)->format('h:i a, F d, Y');
        }
    }
}
