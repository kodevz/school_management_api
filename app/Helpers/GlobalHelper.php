<?php

namespace App\Helpers;

class GlobalHelper
{
    
    /**
     * Get default image url
     *
     * @return void
     */
    public static function getDefaultImage()
    {
        return asset('images/user.png');
    }

    public static function isset($value) 
    {
        return isset($value) && $value ? $value : null;
    }
}
