<?php


return [
    'menu' => [
        'list' => [
            'name' => 'Gallery',
            'description' => 'Manage galleries',
        ],
        'create' => [
            'name' => 'Add gallery',
            'description' => 'Add new albums with images',
        ],
        'update' => [
            'name' => 'Edit gallery',
            'description' => 'Edit gallery',
        ],
        'delete' => [
            'name' => 'Delete gallery',
            'description' => 'Delete all galleries with nested images',
        ],
    ],
    'table' => [
        'updated' => 'Updated',
        'slug' => 'Slug',
        'title' => 'Name',
    ],
    'form' => [
        'main' => 'Main',
        'additional' => 'Additional',
        'gallery' => 'Gallery',
        'info' => [
            'title' => 'Wisdom',
            'text' => 'To use the gallery in the page or news, you can use the Blade of the Directive. Examples: <code>&#64;gallery(\'my-gallery\')</code> or <code>&#64;gallery(1, 2)</code>.',
        ],
        'slug' => 'Slug',
        'title' => 'Title',
        'description' => 'Description',
        'preset' => [
            'name' => 'Upload preset',
        ],
    ],
    'options' => [
        'settings' => [
            'group' => 'Gallery',
        ],
        'index' => [
            'name' => 'Count at index page',
        ],
        'paginate' => [
            'name' => 'Count per page',
        ],
        'presets' => [
            'name' => 'Show upload preset selector',
        ],
    ],
];
