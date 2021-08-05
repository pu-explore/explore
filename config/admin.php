<?php

return [
    'name' => '<b>Admin</b>LTE',
    'logo' => asset('img/AdminLTELogo.png'),
    'color' => 'info',

    'default_avatar' => '/img/user2-160x160.jpg',

    'upload' => [
        // Disk in `config/filesystem.php`.
        'disk' => 'admin',

        // Image and file upload path under the disk above.
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    'menu_groups' => [
        '菜单'
    ],
];
