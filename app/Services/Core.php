<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;

abstract class Core
{      
    CONST CACHE_KEY = 'CARS';

    protected $key;

    public function getCacheKey($key){

        $key = strtoupper($key);
        
        return self::CACHE_KEY .".$key";
    }

    public function clearCache(){
        return Artisan::call('cache:clear');
    }
}