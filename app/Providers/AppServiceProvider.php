<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Observers\PostObserver;
use \App\Observers\PictureObserver;
use \App\Post;
use \App\Picture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Picture::observe(PictureObserver::class);
    }
}
