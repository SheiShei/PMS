<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Workbook extends Model
{
    use Uuids, SoftDeletes;

    public $incrementing = false;
    
    protected $fillable = ['name', 'description', 'status', 'created_by', 'brand_id', 'overall_rating', 'reviewed_at'];

    protected $dates = ['deleted_at'];

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
