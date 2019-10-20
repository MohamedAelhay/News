<?php


namespace App\Contracts;


interface ArticleContract
{

    public function find($id);

    public function updateArticle($values);

    public function deleteImagesWhereIn($ids);

    public function createManyImages($imagesAttributes);

    public function deleteDocumentsWhereIn($ids);

    public function createManyDocuments($docsAttributes);

    public function deleteRelatedTopicsWhereIn($ids = Null);

    public function createManyRelatedTopics($related_ids);
}
