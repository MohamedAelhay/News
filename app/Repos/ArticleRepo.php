<?php


namespace App\Repos;


use App\Article;
use App\Contracts\ArticleContract;

class ArticleRepo implements ArticleContract
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function find($id)
    {
        $this->article = $this->article->findOrFail($id);
        return $this;
    }

    public function updateArticle($values)
    {
        $this->article->update($values);
        return $this;
    }

    public function deleteImagesWhereIn($ids)
    {
        !isset($ids) ?: $this->article->images()->whereIn('id', $ids)->delete();
        return $this;
    }

    public function createManyImages($imagesAttributes)
    {
        !isset($imagesAttributes) ?: $this->article->images()->createMany($imagesAttributes);
        return $this;
    }

    public function deleteDocumentsWhereIn($ids)
    {
        !isset($ids) ?: $this->article->documents()->whereIn('id', $ids)->delete();
        return $this;
    }

    public function createManyDocuments($docsAttributes)
    {
        !isset($docsAttributes) ?: $this->article->documents()->createMany($docsAttributes);
        return $this;
    }

    public function deleteRelatedTopicsWhereIn($ids = Null)
    {
        isset($ids) ? $this->article->relatedTopics()->whereIn('id', $ids)->delete() : $this->article->relatedTopics()->delete();
        return $this;
    }

    public function createManyRelatedTopics($related_ids)
    {
        !isset($related_ids) ?: $this->article->relatedTopics()->createMany($related_ids);
        return $this;
    }
}
