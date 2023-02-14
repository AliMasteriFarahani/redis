<?php

use App\Models\Article;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    //=================================================
    // use laravel facade : 

    //   in config / database.php
    // 'client' => env('REDIS_CLIENT', 'phpredis'),
    // changed in php version 8 : up to bottom
    // 'client' => env('REDIS_CLIENT', 'predis'),
    //=================================================
    
    
    // if (!is_null($articles = Redis::get('articles'))) {
    //     return unserialize($articles);
    // }
    
    // $articles = Article::all();
    // Redis::setex('articles', 60, serialize($articles));
    // return $articles;
    
    
    //=================================================
    //=================================================
    // use cache : 
    
    // in .env : 
    // CACHE_DRIVER=redis
    //=================================================
    
    
    $articles = cache()->remember('articles', 60, function () {
        return Article::all();
    });


    // ==
    // $articles = Cache::remember('articles', 60, function () {
    //     return Article::all();
    // });


    // if (!is_null($articles = cache()->get('articles'))) {
    //     return $articles;
    // }
    // $articles = Article::all();
    // cache()->set('articles',$articles,60);

    return $articles;
});
