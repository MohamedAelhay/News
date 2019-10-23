<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['main_title', 'second_title', 'content', 'start_date', 'end_date', 'is_publish'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imgable');
    }

    public function visitors()
    {
        return $this->belongsToMany(Visitor::class);
    }

    public function locations()
    {
        return $this->hasOne(Location::class);
    }

    public function getStartTimeAttribute()
    {
        return explode(' ', $this->start_date)[1];
    }

    public function getEndTimeAttribute()
    {
        return explode(' ', $this->end_date)[1];
    }
}
