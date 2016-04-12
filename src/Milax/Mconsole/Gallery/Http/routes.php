<?php

/**
 * Gallery module routes file
 */
Route::group([
    'prefix' => 'mconsole',
    'middleware' => ['web', 'mconsole'],
    'namespace' => 'Milax\Mconsole\Gallery\Http\Controllers',
], function () {
    
    Route::resource('/gallery', 'GalleryController');

});
