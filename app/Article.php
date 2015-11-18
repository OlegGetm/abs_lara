<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function authors()
    {
        return $this->belongsToMany('App\Author');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public function similars($limit = 4)
    {
        return Article::
            select('id', 'title', 'slug', 'image_src')
            ->where(['category_id' => $this->category_id,
                'state' => 1,])
            ->where('id', '<>', $this->id)
            ->orderByRaw("RANDOM()")
            ->take($limit)
            ->get();
    }


    public static function multiArrayzer($collection)
    {
        $out = [];
        foreach ($collection as  $item) {
            $out[$item->pos][$item->subpos] = $item;
        }
        return $out;
    }


}
