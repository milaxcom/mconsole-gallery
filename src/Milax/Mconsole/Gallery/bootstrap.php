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
            Milax\Mconsole\Gallery\Provider::class,
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
            'name' => 'Galleries',
            'translation' => 'gallery.menu.list.name',
            'url' => 'gallery',
            'visible' => true,
            'enabled' => true,
        ], 'gallery', 'content');
        
        app('API')->acl->register([
            ['GET', 'gallery', 'gallery.acl.index', 'gallery'],
            ['GET', 'gallery/create', 'gallery.acl.create'],
            ['POST', 'gallery', 'gallery.acl.store'],
            ['GET', 'gallery/{gallery}/edit', 'gallery.acl.edit'],
            ['PUT', 'gallery/{gallery}', 'gallery.acl.update'],
            ['GET', 'gallery/{gallery}', 'gallery.acl.show'],
            ['DELETE', 'gallery/{gallery}', 'gallery.acl.destroy'],
        ]);
        
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
