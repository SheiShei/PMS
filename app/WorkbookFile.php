<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkbookFile extends Model
{
    protected $fillable = ['workbook_id', 'original_filename', 'new_filename', 'caption'];

    public function workbook() {
        return $this->belongsTo('App\Workbook');
    }
}
