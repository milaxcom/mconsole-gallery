<?php

namespace Milax\Mconsole\Gallery;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // ..
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Milax\Mconsole\Gallery\Contracts\Repositories\GalleryRepository', 'Milax\Mconsole\Gallery\Repositories\GalleryRepository');
    }
}
