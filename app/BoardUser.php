<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BoardUser extends Pivot
{
    public function brole() {
        return $this->belongsTo('App\BRole','bRole_id');
    }
}
