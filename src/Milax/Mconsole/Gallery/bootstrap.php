<?php

use Milax\Mconsole\Gallery\Installer;

/**
 * Gallery module bootstrap file
 */
return [
    'name' => 'Gallery',
    'identifier' => 'mconsole-gallery',
    'description' => 'mconsole::gallery.module',
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
            'name' => 'mconsole::gallery.menu',
            'url' => 'gallery',
            'visible' => true,
            'enabled' => true,
        ], 'gallery', 'content');
        
        app('API')->acl->register([
            ['GET', 'gallery', 'mconsole::gallery.acl.index'],
            ['GET', 'gallery/create', 'mconsole::gallery.acl.create'],
            ['POST', 'gallery', 'mconsole::gallery.acl.store'],
            ['GET', 'gallery/{gallery}/edit', 'mconsole::gallery.acl.edit'],
            ['PUT', 'gallery/{gallery}', 'mconsole::gallery.acl.update'],
            ['GET', 'gallery/{gallery}', 'mconsole::gallery.acl.show'],
            ['DELETE', 'gallery/{gallery}', 'mconsole::gallery.acl.destroy'],
        ], 'gallery');
        
        // Register in search engine
        app('API')->search->register(function ($text) {
            return \Milax\Mconsole\Gallery\Models\Gallery::select('id', 'title', 'slug')->where('slug', 'like', sprintf('%%%s%%', $text))->orWhere('title', 'like', sprintf('%%%s%%', $text))->get()->transform(function ($result) {
                return [
                    'title' => sprintf('%s', $result->title),
                    'description' => sprintf('/%s', $result->slug),
                    'link' => mconsole_url(sprintf('gallery/%s/edit', $result->id)),
                    'tags' => ['gallery', sprintf('#%s', $result->id)],
                ];
            });
        });
        
        // Register in quick menu
        app('API')->quickmenu->register(function () {
            return [
                'text' => trans('mconsole::gallery.quickmenu.create'),
                'link' => mconsole_url('gallery/create'),
            ];
        });
    },
];
