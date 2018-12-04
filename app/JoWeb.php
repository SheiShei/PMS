<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoWeb extends Model
{
    protected $fillable = ['request_type', 'tech', 'domain_transfer', 'domain_renewal', 'action_points', 'target_list', 'web_proofed_by', 'web_proofed_at', 'acma_proofed_by', 'acma_proofed_at'];

    public function joborder() {
        return $this->belongsTo('App\JobOrder', 'jo_id');
    }

    public function web_proofed_by() {
        return $this->belongsTo('App\User', 'web_proofed_by');
    }

    public function acma_proofed_by() {
        return $this->belongsTo('App\User', 'acma_proofed_by');
    }
}
