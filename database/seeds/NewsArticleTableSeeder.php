<?php

use App\Article;
use Illuminate\Database\Seeder;

class NewsArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (factory(Article::class, 5)->create() as $article)
        {
            $article->images()->create(['image'=>'articles/images/ttegAcIRjcACNB0pQBR1zLQNmYgjAQkGgyWt7fUZ.jpeg']);
            $article->images()->create(['image'=>'articles/images/ttegAcIRjcACNB0pQBR1zLQNmYgjAQkGgyWt7fUZ.jpeg']);
            $article->documents()->create(['document'=>'articles/docs/dkkAEwQigCJwhu3fMZh4AnngatudWyShNdcUuGgA.pdf']);
            $article->documents()->create(['document'=>'articles/docs/dkkAEwQigCJwhu3fMZh4AnngatudWyShNdcUuGgA.pdf']);

        };
    }
}
