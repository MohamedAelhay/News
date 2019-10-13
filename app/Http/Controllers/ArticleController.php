<?php

namespace App\Http\Controllers;

use App\Http\Requests\articles\ArticleStoreRequest;
use App\Http\Requests\articles\ArticleUpdateRequest;
use App\Work;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;


class ArticleController extends Controller
{

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articles.create", [
            "articles" => Article::all()->pluck("main_title", "id"),
            'works' => Work::pluck("description", "id"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        return view('articles.edit', [
           "topic" => $article,
           "articles" => Article::all()->pluck("main_title", "id"),
           "related" => $article->relatedTopics->pluck("related_id"),
           "works" => Work::pluck("description", "id"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, article $article)
    {
        $article->update($request->all());

        $article->images()->delete();
        $article->images()->createMany($this->getAttr("image", $request->input("images")));

        $article->documents()->delete();
        $article->documents()->createMany($this->getAttr('document', $request->input("files")));

        $article->relatedTopics()->delete();
        $article->relatedTopics()->createMany($this->getAttr("related_id", $request->input("related_id")));

        return redirect()->route('articles.index')->with([
            'success' => 'Article "'.$request->main_title.'" has been Updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        $article->relatedTopics()->delete();
        $article->delete();
        return redirect()->route('articles.index')->with(
            [
                'success' => 'Topic "'.$article->main_title .'" has been Deleted.'
            ]
        );
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
