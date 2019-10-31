<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description'];

    public function image()
    {
        return $this->hasOne(Upload::class)->where(['type' => 'image']);
    }

    public function video()
    {
        return $this->hasOne(Upload::class)->where(['type' => 'video']);
    }

    public function document()
    {
        return $this->hasOne(Upload::class)->where(['type' => 'document']);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}
