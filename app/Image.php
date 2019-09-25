<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image', 'imgable_id', 'imgable_type'];

    public function imgable()
    {
        return $this->morphTo();
    }
}
