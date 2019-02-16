<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileRevision extends Model
{
    protected $fillable = ['original_filename', 'new_filename', 'caption', 'wfile_id', 'rating', 'comment'];

    public function file() {
        return $this->belongsTo('App\WorkbookFile', 'wfile_id');
    }

    public function getNewFilenameAttribute($img) {
        return '/storage/workbook/' . $img;
    }
}
