<?php

namespace App;

use App\Traits\Toggle;
use App\Traits\Uploads;
use Webpatser\Countries\Countries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use Toggle;
    use Uploads;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
