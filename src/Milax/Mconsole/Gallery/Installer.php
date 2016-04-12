<?php

namespace Milax\Mconsole\Gallery;

use Milax\Mconsole\Contracts\ModuleInstaller;
use Milax\Mconsole\Models\MconsoleOption;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'label' => 'gallery.options.index.name',
            'key' => 'gallery_index_count',
            'value' => '1',
            'type' => 'text',
            'enabled' => 1,
        ],
        [
            'label' => 'gallery.options.paginate.name',
            'key' => 'gallery_paginate_count',
            'value' => '12',
            'type' => 'text',
            'enabled' => 1,
        ],
    ];
    
    public static function install()
    {
        foreach (self::$options as $option) {
            if (MconsoleOption::where('key', $option['key'])->count() == 0) {
                MconsoleOption::create($option);
            }
        }
    }
    
    public static function uninstall()
    {
        foreach (self::$options as $option) {
            MconsoleOption::where('key', $option['key'])->delete();
        }
    }
}
