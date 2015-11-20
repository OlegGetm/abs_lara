<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FetchModel extends Model
{   
    private $query;
    private $params;

    public $conditions = [];
    public $relations = [];
    public $likes = [];
    public $with = [];
    public $pages = 10;

    public function __construct($query)
    {
        $this->query = $query;
        $this->params = array_merge(\Route::current()->parameters(),
                                    \Request::input());
    }


     public function fetch()
     {
        foreach ($this->params as $g => $value) {
              if (isset($this->conditions[$g])) {
                $this->query->where([$this->conditions[$g] => $value]);
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
        return $this->query->paginate($this->pages);
     }

}
