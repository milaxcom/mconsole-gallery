<?php


return [
    'module' => 'Create galleries for grouping images',
    'quickmenu' => [
        'create' => 'Add gallery',
    ],
    'menu' => 'Gallery',
    'table' => [
        'updated' => 'Updated',
        'slug' => 'Address',
        'title' => 'Name',
    ],
    'form' => [
        'main' => 'Main',
        'additional' => 'Additional',
        'cover' => 'Cover',
        'gallery' => 'Gallery',
        'slug' => 'Slug',
        'title' => 'Title',
        'description' => 'Description',
    ],
    'info' => [
        'title' => 'Wisdom',
        'text' => 'To use the gallery in the page or news, you can use the Blade of the Directive. Examples: <code>&#64;gallery(\'my-gallery\')</code> or <code>&#64;gallery(1, 2)</code>.',
    ],
    'options' => [
        'settings' => [
            'group' => 'Gallery',
        ],
        'index' => [
            'name' => 'Galleries at home',
        ],
        'paginate' => [
            'name' => 'Galleries per page',
        ],
        'presets' => [
            'name' => 'Show upload preset selector',
        ],
        'cover' => [
            'name' => 'Use cover',
        ],
    ],
    'acl' => [
        'index' => 'Gallery: show list',
        'create' => 'Gallery: show create form',
        'store' => 'Gallery: saving',
        'edit' => 'Gallery: show edit form',
        'update' => 'Gallery: updating',
        'show' => 'Gallery: view',
        'destroy' => 'Gallery: delete',
    ],
];
