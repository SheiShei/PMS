<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoCreative extends Model
{
    protected $fillable = ['ad_type', 'file_type', 'jo_id', 'copy', 'status', 'revisions', 'completed_at', 'signed_by'];

    public function joborder() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }

    public function signed_by() {
        return $this->belongsTo('App\User', 'signed_by');
    }
}
