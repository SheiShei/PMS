<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workbook extends Model
{
    use Uuids;

    public $incrementing = false;
    
    protected $fillable = ['name', 'description', 'status', 'created_by', 'brand_id'];

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function files() {
        return $this->hasMany('App\WorkbookFile');
    }
}
