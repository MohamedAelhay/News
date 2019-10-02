<?php

namespace App;

use App\Traits\ImageUpload;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Countries\Countries;

class Visitor extends Model
{
    use ImageUpload;

    protected $fillable = ['gender', 'user_id', 'city_id','country_id', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
