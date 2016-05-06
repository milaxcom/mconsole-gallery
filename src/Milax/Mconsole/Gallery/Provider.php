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
        app('API')->repositories->register('galleries', new \Milax\Mconsole\Gallery\GalleryRepository(\Milax\Mconsole\Gallery\Models\Gallery::class));
        
        $this->app->when('\Milax\Mconsole\Gallery\Http\Controllers\GalleryController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return app('API')->repositories->galleries;
            });
    }
}
