<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tandem extends Model
{
    protected $fillable = ['name', 'acma_id', 'ga_id'];

    public function ga_user() {
        return $this->belongsTo('App\User', 'ga_id');
    }

    public function acma_user() {
        return $this->belongsTo('App\User', 'acma_id');
    }

    public function brands() {
        return $this->hasMany('App\Brand');
    }
}
