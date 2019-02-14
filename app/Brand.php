<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes, Uuids;

    public $incrementing = false;
    
    protected $fillable = ['name', 'contact_person', 'email', 'password', 'about', 'telephone', 'mobile', 'logo', 'acma_id'];

    public function acma() {
        return $this->belongsTo('App\User','acma_id');
    }

    public function jos() {
        return $this->hasMany('App\JobOrder');
    }

     public function getLogoAttribute($pic) {
         return '/storage/'.$pic;
     }
}
