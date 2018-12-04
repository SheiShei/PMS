<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use SoftDeletes;

    protected $fillable = ['brand_id', 'client_id', 'tandem_id', 'date_in', 'date_due', 'status', 'created_by', 'type'];

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function tandem() {
        return $this->belongsTo('App\Tandem');
    }

    public function client() {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function jocreatives() {
        return $this->hasOne('App\JoCreative', 'jo_id');
    }

    public function joweb() {
        return $this->hasOne('App\JoWeb', 'jo_id');
    }

}
