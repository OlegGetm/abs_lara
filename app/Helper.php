<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    
    public static function getImageSrc($filePath, $blankImage = null)
    {   
        if (is_file(public_path(ltrim($filePath ,'/')))) {
            return $filePath;
        }  else {
            return $blankImage ? $blankImage : false;
        }
    } 
}
