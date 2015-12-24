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
        
        $article = Article::where(['articles.slug' => $slug])->with('authors', 'tags', 'pictures', 'videos', 'category')->first();

        $pictures = $article->picturesArray;
        return view('article.show', compact('article', 'pictures'));
    }

    
    public function index()
    {   
        $articles = ArticleFetch::make(Article::query()->active());
        return view('article.index', compact('articles'));
    }





}