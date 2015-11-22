<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Article;
use App\Fetch\ArticleFetch;


class ArticleController extends Controller
{

    public function show($slug)
    {   
        // $article = Article::with('authors', 'tags', 'pictures', 'videos', 'category')->findOrFail($id);
        
        $article = Article::where(['slug' => $slug])->with('authors', 'tags', 'pictures', 'videos', 'category')->first();

        $pictures = Article::multiArrayzer($article->pictures);
        $videos   = Article::multiArrayzer($article->videos);

        return view('article.show', compact('article', 'pictures', 'videos'));
    }

    
    public function index()
    {   
        $fetch = new ArticleFetch(Article::query()->active());
        $articles = $fetch->getCollection();
        return view('article.index', compact('articles'));
    }





}