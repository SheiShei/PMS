<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkbookFile extends Model
{
    protected $fillable = ['workbook_id', 'isApproved'];

    public function workbook() {
        return $this->belongsTo('App\Workbook');
    }

    public function revisions() {
        return $this->hasMany('App\FileRevision', 'wfile_id');
    }

}
