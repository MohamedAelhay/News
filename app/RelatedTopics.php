<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedTopics extends Model
{
    protected $fillable = ["article_id", "related_id"];

    public function topic()
    {
        return $this->belongsTo(Article::class, "related_id");
    }

}
