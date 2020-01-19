<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function loadRel()
    {
        return $this->belongsTo(Load::class);
    }
}
