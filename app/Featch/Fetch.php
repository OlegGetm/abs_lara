<?php

/*
|----------------------------------------------------------
|  EXAMPLE:
|----------------------------------------------------------
|    $fetch = new ArticleFetch(Article::query()->active());
|
|    $fetch->conditions = ['issue'];
|    $fetch->relations  = ['tag_slug' => ['tags', 'slug'],
|                              'category_slug' => ['category', 'slug']];
|    $fetch->likes   = ['title', 'name'];
|    
|    $fetch->orderBy = [['articles.created_at', 'asc'], ['articles.issue']];
|    $fetch->with    = ['category'];
|    $fetch->perPage   = 5;
|----------------------------------------------------------    
|    $articles = $fetch->getCollection();
|    OR    
|    $articles = $fetch->getQuery()->paginate(4);
|    
|----------------------------------------------------------    
|  OR  COMPACT if  query has default conditions:
|----------------------------------------------------------    
|    
|   $fetch = new ArticleFetch();
|   $articles = $fetch->getCollection();
|
|----------------------------------------------------------    
|  OR  SUPER COMPACT:
|----------------------------------------------------------  
|     $articles = ArticleFetch::make();
|     
|    $articles = ArticleFetch::make(null, $paginate = false);
| 
| / or /
| 
|     $articles = ArticleFetch::make(Article::query()
|         ->active()->orderBy('articles.title', 'desc'));
| 
|----------------------------------------------------------    
*/

namespace App\Fetch;

use Illuminate\Database\Eloquent\Model;

class Fetch extends Model
{   
    protected $query;
    protected $params;

    public $modelClass = null;
    public $conditions = [];
    public $relations  = [];
    public $likes      = [];
    public $with       = [];
    public $orderBy;
    public $perPage    = 10;


    public function __construct($query = null)
    {   
        if (is_null($query) && !is_null($this->modelClass)) {
           $model = $this->modelClass;
           $this->query = $model::query();
        
        }  else {
            $this->query = $query;
        }

        $this->params = array_merge(\Route::current()->parameters(),
                                    \Request::input());
        if (method_exists($this, 'prepare')) {
            $this->prepare();
        }
    }


    public static function make($query = null, $paginate = true)
    {   
        $instance = new static($query);
        return $instance->getCollection($paginate);
    }

    
    public function getQuery()
    {   
        foreach ($this->params as $g => $value) {

            if (in_array($g, $this->conditions)) { 
                $this->query->where($g, $value);
            }

            if (isset($this->relations[$g])) {
                $rel = $this->relations[$g];
                $this->query->whereHas($rel[0], function($query) use ($value, $rel) {
                    $query->where($rel[1], $value);
                });
            }
        }

        if (count($this->with) > 0) {
            $this->query->with($this->with);
        }
        
        if ($this->orderBy) {
            foreach($this->orderBy as $item) {
                $dir = isset($item[1]) ? $item[1] : 'asc';
                $this->query->orderBy($item[0], $dir);
            }
        }
        return $this->query;
    }


    public function getCollection($paginate = true)
    {   
        $q = $this->getQuery();
        return $paginate ? $q->paginate($this->perPage) : $q->get();
    }

}
