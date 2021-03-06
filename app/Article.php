<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;


class Article extends Model
{
    // use \App\Traits\Models\ModelJoinTrait;

    const ACCESS_STANDARD = 1;  
    const ACCESS_FOR_ALL  = 2;
    const STATE_PUBLISHED = 1;
    const STATE_DRAFT     = 2;


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

    public function magazine()
    {
        return $this->belongsTo('App\Magazine', 'issue', 'issue');
    }

    public function getThumbMidiAttribute()
    {   
        return Helper::getImageSrc('/pictures/article/midi/' . $this->image_src, '/images/blank-image.png');
    }

    public function getPicturesArrayAttribute()
    {   
        return self::multiArrayzer($this->pictures);
    }


    // public function scopeModelJoin($query, $relation_name, $operator = '=', $type = 'left', $where = false) {
    //     $relation = $this->$relation_name();
    //     $table = $relation->getRelated()->getTable();
    //     $one = $relation->getQualifiedParentKeyName();
    //     $two = $relation->getForeignKey();

    //     if (empty($query->columns)) {
    //         $query->select($this->getTable().".*");
    //     }
    //     foreach (\Schema::getColumnListing($table) as $related_column) {
    //         $query->addSelect("`$table`.`$related_column` AS `$table.$related_column`");
    //     }
    //     return $query->join($table, $one, $operator, $two, $type, $where); 
    //     //->with($relation_name);

    // }


    public function scopeActive($query)
    {
        return $query
            ->leftJoin('magazines', 'magazines.issue', '=', 'articles.issue')
            ->where('articles.state', static::STATE_PUBLISHED)
            ->where('magazines.access', '<>', Magazine::ACCESS_DENY);
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
