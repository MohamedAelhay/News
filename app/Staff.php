<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Countries\Countries;

class Staff extends Model
{
    protected $fillable = ['gender', 'work_id', 'user_id', 'city_id','country_id', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imgable');
    }
}
