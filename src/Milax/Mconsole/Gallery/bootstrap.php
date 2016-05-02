<?php

use Milax\Mconsole\Gallery\Installer;

/**
 * Gallery module bootstrap file
 */
return [
    'name' => 'Gallery',
    'identifier' => 'mconsole-gallery',
    'description' => 'mconsole::gallery.module.description',
    'register' => [
        'middleware' => [],
        'providers' => [
            Milax\Mconsole\Gallery\GalleryServiceProvider::class,
        ],
        'aliases' => [],
        'bindings' => [],
        'dependencies' => [],
    ],
    'install' => function () {
        Installer::install();
    },
    'uninstall' => function () {
        Installer::uninstall();
    },
    'init' => function () {
        app('API')->menu->push([
            'name' => 'All galleries',
            'translation' => 'gallery.menu.list.name',
            'url' => 'gallery',
            'description' => 'gallery.menu.list.description',
            'route' => 'mconsole.gallery.index',
            'visible' => true,
            'enabled' => true,
        ], 'gallery_all', 'content');
        app('API')->menu->push([
            'name' => 'Create gallery',
            'translation' => 'gallery.menu.create.name',
            'url' => 'pages/create',
            'description' => 'gallery.menu.create.description',
            'route' => 'mconsole.gallery.create',
            'visible' => false,
            'enabled' => true,
        ], 'gallery_form', 'content');
        app('API')->menu->push([
            'name' => 'Edit galleries',
            'translation' => 'gallery.menu.update.name',
            'description' => 'gallery.menu.update.description',
            'route' => 'mconsole.gallery.edit',
            'visible' => false,
            'enabled' => true,
        ], 'gallery_update', 'content');
        app('API')->menu->push([
            'name' => 'Delete galleries',
            'translation' => 'gallery.menu.delete.name',
            'description' => 'gallery.menu.delete.description',
            'route' => 'mconsole.gallery.destroy',
            'visible' => false,
            'enabled' => true,
        ], 'gallery_delete', 'content');
        
        // Register in search engine
        app('API')->search->register(function ($text) {
            return \Milax\Mconsole\Gallery\Models\Gallery::select('id', 'title', 'slug')->where('slug', 'like', sprintf('%%%s%%', $text))->orWhere('title', 'like', sprintf('%%%s%%', $text))->get()->transform(function ($gallery) {
                return [
                    'icon' => 'file-image-o',
                    'title' => sprintf('%s', $gallery->title),
                    'description' => sprintf('/%s', $gallery->slug),
                    'link' => sprintf('/mconsole/gallery/%s/edit', $gallery->id),
                ];
            });
        });
        
        // Register in quick menu
        app('API')->quickmenu->register(function () {
            $link = new \stdClass();
            $link->icon = 'fa fa-plus';
            $link->color = 'label-success';
            $link->text = trans('mconsole::gallery.menu.create.name');
            $link->link = '/mconsole/gallery/create';
            return $link;
        });
    },
];
