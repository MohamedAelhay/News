<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['image', 'imgable_id', 'imgable_type'];

    public function imgable()
    {
        return $this->morphTo();
    }
}
