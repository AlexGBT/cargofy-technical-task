<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function routeWay()
    {
        return $this->hasOne(Route::class);
    }
}
