<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function routeWays()
    {
        return $this->hasMany(Route::class);
    }
}
