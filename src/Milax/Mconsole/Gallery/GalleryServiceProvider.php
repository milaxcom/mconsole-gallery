<?php

namespace Milax\Mconsole\Gallery;

use Illuminate\Support\ServiceProvider;
use Milax\Mconsole\Gallery\GalleryRepository;
use Milax\Mconsole\Gallery\Models\Gallery;

class GalleryServiceProvider extends ServiceProvider
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
        $this->app->when('\Milax\Mconsole\Gallery\Http\Controllers\GalleryController')
            ->needs('\Milax\Mconsole\Contracts\Repository')
            ->give(function () {
                return new GalleryRepository(Gallery::class);
            });
    }
}
