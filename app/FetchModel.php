<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FetchModel extends Model
{   
    private $query;
    private $params;

    public $conditions = [];
    public $relations  = [];
    public $likes      = [];
    public $with       = [];
    public $orderBy;
    public $perPage    = 10;


    public function __construct($query)
    {
        $this->query = $query;
        $this->params = array_merge(\Route::current()->parameters(),
                                    \Request::input());
    }


    public function prepare()
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



    public function fetch($paginate = true)
    {   
        $q = $this->prepare();
        return $paginate ? $q->paginate($this->perPage) : $q->get();
    }

}
