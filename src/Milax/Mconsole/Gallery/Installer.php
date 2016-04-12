<?php

namespace Milax\Mconsole\Gallery;

use Milax\Mconsole\Contracts\ModuleInstaller;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'label' => 'gallery.options.index.name',
            'key' => 'gallery_index_count',
            'value' => 1,
            'rules' => ['required', 'integer'],
            'type' => 'text',
            'enabled' => 1,
        ],
        [
            'label' => 'gallery.options.paginate.name',
            'key' => 'gallery_paginate_count',
            'value' => 12,
            'rules' => ['required', 'integer'],
            'type' => 'text',
            'enabled' => 1,
        ],
    ];
    
    public static function install()
    {
        app('API')->options->install(self::$options);
    }
    
    public static function uninstall()
    {
        app('API')->options->uninstall(self::$options);
    }
}
