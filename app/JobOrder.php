<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class JobOrder extends Model
{
    use SoftDeletes, Uuids;
    
    public $incrementing = false;

    protected $fillable = ['name', 'brand_id', 'client_id', 'tandem_id', 'date_in', 'date_due', 'status', 'created_by', 'type'];

    protected $appends = array('indate', 'duedate');

    public function brand() {
        return $this->belongsTo('App\Brand');
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

    public function tasks() {
        return $this->hasMany('App\Task', 'jo_id');
    }

    public function getIndateAttribute() {
        return Carbon::parse($this->attributes['date_in'])->format('F d, Y');
    }

    public function getDuedateAttribute() {
        return Carbon::parse($this->attributes['date_due'])->format('F d, Y');
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('M d, Y');
    }

}
