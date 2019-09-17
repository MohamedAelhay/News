<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Countries\Countries;

class City extends Model
{
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }
}
