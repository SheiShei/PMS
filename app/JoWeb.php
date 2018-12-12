<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JoWeb extends Model
{
    protected $fillable = ['request_type', 'tech', 'domain_transfer', 'domain_renewal', 'action_points', 'target_list', 'web_proofed_by', 'web_proofed_at', 'acma_proofed_by', 'acma_proofed_at', 'old_cpanel_uname', 'new_cpanel_uname', 'old_cpanel_password', 'new_cpanel_password', 'date_commerced','date_ended'
    ];

    protected $appends = array('commenceddate', 'enddate');

    public function joborder() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }

    public function web_signed_by() {
        return $this->belongsTo('App\User', 'web_proofed_by');
    }

    public function acma_signed_by() {
        return $this->belongsTo('App\User', 'acma_proofed_by');
    }

    public function getCommenceddateAttribute() {
        if($this->attributes['date_commerced']) {
            return Carbon::parse($this->attributes['date_commerced'])->format('F d, Y');
        }
        return null;
    }

    public function getEnddateAttribute() {
        if($this->attributes['date_ended']) {
            return Carbon::parse($this->attributes['date_ended'])->format('F d, Y');
        }
        return null;
    }

    public function getWebProofedAtAttribute($date) {
        if($date) {
            return Carbon::parse($date)->format('h:i a , F d, Y');
        }
    }

    public function getAcmaProofedAtAttribute($date) {
        if($date) {
            return Carbon::parse($date)->format('h:i a , F d, Y');
        }
    }
}
