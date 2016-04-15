<?php

namespace Milax\Mconsole\Gallery;

use Milax\Mconsole\Contracts\ModuleInstaller;
use Milax\Mconsole\Models\MconsoleUploadPreset;

class Installer implements ModuleInstaller
{
    public static $options = [
        [
            'group' => 'gallery.options.settings.group',
            'label' => 'gallery.options.index.name',
            'key' => 'gallery_index_count',
            'value' => 1,
            'rules' => ['required', 'integer'],
            'type' => 'text',
            'enabled' => 1,
        ],
        [
            'group' => 'gallery.options.settings.group',
            'label' => 'gallery.options.paginate.name',
            'key' => 'gallery_paginate_count',
            'value' => 12,
            'rules' => ['required', 'integer'],
            'type' => 'text',
            'enabled' => 1,
        ],
        [
            'group' => 'gallery.options.settings.group',
            'label' => 'gallery.options.presets.name',
            'key' => 'gallery_show_presets',
            'value' => '0',
            'type' => 'select',
            'options' => ['1' => 'settings.options.on', '0' => 'settings.options.off'],
        ],
    ];
    
    public static $presets = [
        [
            'key' => 'gallery',
            'name' => 'Gallery',
            'path' => 'gallery',
            'extensions' => ['jpg', 'jpeg', 'png'],
            'min_width' => 800,
            'min_height' => 600,
            'operations' => [
                [
                    'operation' => 'resize',
                    'type' => 'ratio',
                    'width' => '800',
                    'height' => '600',
                ],
                [
                    'operation' => 'save',
                    'path' => 'gallery',
                    'quality' => '',
                ],
                [
                    'operation' => 'resize',
                    'type' => 'center',
                    'width' => '90',
                    'height' => '90',
                ],
                [
                    'operation' => 'save',
                    'path' => 'preview',
                    'quality' => '',
                ],
            ],
        ],
    ];
    
    public static function install()
    {
        app('API')->options->install(self::$options);
        
        foreach (self::$presets as $preset) {
            if (MconsoleUploadPreset::where('key', $preset['key'])->count() == 0) {
                MconsoleUploadPreset::create($preset);
            }
        }
    }
    
    public static function uninstall()
    {
        app('API')->options->uninstall(self::$options);
        
        foreach (self::$presets as $preset) {
            MconsoleUploadPreset::where('key', $preset['key'])->delete();
        }
    }
}
