<?php

namespace App\Providers;

use App\Models\Picture;
use App\Models\Post;
use App\Observers\PictureObserver;
use App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
