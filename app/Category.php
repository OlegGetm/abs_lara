<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function parent() {
        // return $this->belongsToMany('App\Category', 'categoties', 'parent_id', 'id');
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function getFullNameAttribute()
    {
        return $this->parent->name . ' / ' . $this->name;

    }

}
