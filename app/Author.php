<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    public function getFullNameAttribute()
    {
        $name = !empty($this->firstname) ? $this->firstname . ' ' : '';
        $name .= $this->lastname;
        return empty($this->job) ? $name : $name . ', ' . $this->job;
    }
}
