<?php


return [
    'module' => [
        'description' => 'Create galleries for grouping images',
    ],
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
        'preset' => 'Upload preset',
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
