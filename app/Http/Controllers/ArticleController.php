<?php

namespace App\Http\Controllers;

use App\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\articles\ArticleStoreRequest;
use App\Http\Requests\articles\ArticleUpdateRequest;


class ArticleController extends Controller
{
    protected $article_service;

    public function __construct(ArticleService $service)
    {
        $this->article_service = $service;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::eloquent(Article::query()->with("relatedTopics"))
                ->addColumn('actions', function ($article){
                    return view('articles.actions', compact('article'));
                })
                ->editColumn('is_publish', function ($article){
                    return ($article->is_publish ? "Publish" : "Not Publish");
                })
                ->toJson();
        }

        return view("articles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("articles.create", [
            "articles" => Article::pluck("main_title", "id"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleStoreRequest $request
     * @return Response
     */
    public function store(ArticleStoreRequest $request)
    {
        $article = Article::create($request->all());

        $article->images()->createMany($this->getAttr("image", $request->input("images")));

        $article->documents()->createMany($this->getAttr('document', $request->input("files")));

        $article->relatedTopics()->createMany($this->getAttr("related_id", $request->input("related_id")));

        return redirect()->route('articles.index')->with([
            'success' => 'Article "'.$request->main_title.'" has been Create.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\article  $article
     * @return Response
     */
    public function show(article $article)
    {
        return view("articles.show", [
           "article" => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\article  $article
     * @return Response
     */
    public function edit(article $article)
    {
        return view('articles.edit', [
           "topic" => $article,
           "articles" => Article::pluck("main_title", "id"),
           "related" => $article->relatedTopics->pluck("related_id"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\article  $article
     * @return Response
     */
    public function update(ArticleUpdateRequest $request, $article)
    {
        $this->article_service->update($request->input(), $article);

        return redirect()->route('articles.index')->with([
            'success' => 'Article "'.$request->main_title.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\article  $article
     * @return Response
     */
    public function destroy(article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with(
            [
                'success' => 'Topic "'.$article->main_title .'" has been Deleted.'
            ]
        );
    }
}
