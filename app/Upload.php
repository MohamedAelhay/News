<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description', 'type', 'folder_id', 'path'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
