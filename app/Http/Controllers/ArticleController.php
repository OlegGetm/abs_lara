<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Article;
use App\FetchModel;


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

    
    public function indexA($tag_slug = null, $category_slug = null)
    {   
        $q = Article::query();

        if ($tag_slug) {
            $q->whereHas('tags', function ($query) use ($tag_slug) {
                $query->where('slug', $tag_slug);
            });
        }
        if ($category_slug) {
            $q->whereHas('category', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);
            });
        }
        $articles = $q->with('authors', 'tags', 'category')->paginate(10);
        return view('article.index', compact('articles'));
    }


    public function index()
    {   
        $fetch = new FetchModel(Article::query()->active());
        $fetch->conditions = ['issue'];
        $fetch->relations  = ['tag_slug' => ['tags', 'slug'],
                              'category_slug' => ['category', 'slug']];
        $fetch->with       = ['authors', 'tags', 'category'];
        // $fetch->likes   = $likes;
        // $fetch->perPage   = 5;
        $fetch->orderBy    = [['articles.created_at', 'asc'], ['articles.issue']];
        
        // $articles = $fetch->prepare()->paginate(4);
        $articles = $fetch->fetch();

        return view('article.index', compact('articles'));
       
    }





}