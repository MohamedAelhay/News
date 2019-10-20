<?php


namespace App\Services;


use App\Contracts\ArticleContract;

class ArticleService
{
    protected $article;

    public function __construct(ArticleContract $article_repo)
    {
        $this->article = $article_repo;
    }

    public function update($attributes, $id)
    {
        $this->article->find($id)
                      ->updateArticle($attributes)
                      ->deleteRelatedTopicsWhereIn()
                      ->deleteImagesWhereIn($attributes['deleted_images'])
                      ->deleteDocumentsWhereIn($attributes['deleted_files'])
                      ->createManyImages($this->getAttr("image", $attributes['images']))
                      ->createManyDocuments($this->getAttr('document', $attributes['files']))
                      ->createManyRelatedTopics($this->getAttr('related_id', $attributes['related_id']));
    }

    public function getAttr($attr, $inputs)
    {
        $arr = array();
        foreach($inputs as $input){
            $arr[] = [$attr=>$input];
        }
        return $arr;
    }
}
