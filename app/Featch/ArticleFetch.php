<?php

namespace App\Fetch;

use App\Fetch\Fetch;


class ArticleFetch extends Fetch
{   
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
