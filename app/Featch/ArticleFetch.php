<?php

namespace App\Fetch;

use App\Fetch\Fetch;
use App\Article;


class ArticleFetch extends Fetch
{   

    public $modelClass = 'App\Article';
    public $conditions = ['issue'];
    public $relations  = ['tag_slug' => ['tags', 'slug'],
                          'category_slug' => ['category', 'slug']];
    public $orderBy    = [['articles.created_at', 'asc'], ['articles.issue']];
    public $perPage    = 10;


    public function prepare()
    {
        $this->query
            ->select('slug', 'title', 'image_src', 'category_id')
            ->with('category');
    }

}
