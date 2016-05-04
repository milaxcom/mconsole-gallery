<?php 

return [
    'module' => [
        'description' => 'Создание галерей для группировки изображений',
    ],
    'menu' => [
        'list' => [
            'name' => 'Галереи',
            'description' => 'Управление галереями',
        ],
        'create' => [
            'name' => 'Добавить галерею',
            'description' => 'Добавление новых альбомов с изображениями',
        ],
        'update' => [
            'name' => 'Редактировать галерею',
            'description' => 'Редактировать существующие галереи',
        ],
        'delete' => [
            'name' => 'Удалить галерею',
            'description' => 'Удаление галерей со всеми вложенными изображениями',
        ],
    ],
    'table' => [
        'updated' => 'Обновлено',
        'slug' => 'Адрес',
        'title' => 'Название',
    ],
    'form' => [
        'main' => 'Основное',
        'additional' => 'Настройки',
        'cover' => 'Обложка',
        'gallery' => 'Изображения',
        'slug' => 'Адрес',
        'title' => 'Название',
        'description' => 'Описание (HTML)',
        'preset' => 'Шаблон загрузки',
    ],
    'info' => [
        'title' => 'Мудрость',
        'text' => 'Чтобы использовать галереи в тексте страниц или новостей, можно использовать Blade директивы. Примеры: <code>&#64;gallery(\'my-gallery\')</code> или <code>&#64;gallery(1, 2)</code>.',
    ],
    'options' => [
        'settings' => [
            'group' => 'Галерея',
        ],
        'index' => [
            'name' => 'Галерей на главной',
        ],
        'paginate' => [
            'name' => 'Галерей на страницу',
        ],
        'presets' => [
            'name' => 'Показать выбор шаблона загрузки',
        ],
        'cover' => [
            'name' => 'Загружать обложку альбома',
        ],
    ],
    'acl' => [
        'index' => 'Галерея: просмотр списка',
        'create' => 'Галерея: форма создания',
        'store' => 'Галерея: сохранение',
        'edit' => 'Галерея: форма редактирования',
        'update' => 'Галерея: обновление',
        'show' => 'Галерея: просмотр',
        'destroy' => 'Галерея: удаление',
    ],
];