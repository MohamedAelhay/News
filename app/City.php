<?php

namespace App;

use Webpatser\Countries\Countries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }
}
