<?php

namespace App\Providers;

use App\Article;
use App\Repos\ArticleRepo;
use App\Contracts\ArticleContract;
use App\Observers\ArticleObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(ArticleContract::class, ArticleRepo::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
    }
}
