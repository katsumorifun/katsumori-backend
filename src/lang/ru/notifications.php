<?php

return [
    'login' => [
        'site' => 'сайт',
        'message' => 'Был произведен вход через :app_name в вашу учетную запись на ' . config('app.name') . '.',
        'location' => 'IP адрес: :ip (:country, :city)',
        'subject' => 'Зафиксирован новый вход в учетную запись',
        'actions' => [
            'activity' => 'Просмотреть всю активность аккаунта'
        ]
    ]
];
