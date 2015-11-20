<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;


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

        dd($articles); exit;

        return view('article.index', compact('articles'));
       
    }


    public function index()
    {   
        $conditions = ['issue'];
        $relations = [
            'tag_slug'      => ['tags', 'slug'],
            'category_slug' => ['category', 'slug'],
        ];
        $likes = [];
        //.....................................

        $params = array_merge(\Route::current()->parameters(),
                              \Request::input());
        
        $q = Article::query();

        foreach ($params as $g => $value) {
            
            if (in_array($g, $conditions)) {
                $q->where([$g => $value]);
            }

            if (isset($relations[$g])) {
                $rel = $relations[$g];
                $q->whereHas($rel[0], function ($query) use ($value, $rel) {
                    $query->where($rel[1], $value);
                });
            }    
        }

        $articles = $q->with('authors', 'tags', 'category')->paginate(10);

        // dd($articles); exit;

        return view('article.index', compact('articles'));
       
    }







}