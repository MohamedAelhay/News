<?php

namespace App;

use App\Traits\Toggle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use Toggle;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ["main_title", "second_title", "content", "user_id", "type", "is_publish"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imgable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function relatedTopics()
    {
        return $this->hasMany(RelatedTopics::class);
    }

}
