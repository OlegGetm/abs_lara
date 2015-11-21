<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    const PRICE_SINGLE      = 60;
    const PRICE_YEAR        = 60;
    const PRICE_HALFYEAR    = 60;
    const PRICE_QUARTERYEAR = 60;
    
    const ACCESS_FOR_ALL         = 1;
    const ACCESS_FOR_SUBSCRIBERS = 2;
    const ACCESS_DENY            = 3;
}
