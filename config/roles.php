<?php

use App\Models\User;

return [
    User::GUEST_GROUP_ID => [
        'name_en' => 'guest',
        'name_ru' => 'гость',
        'permissions' => [
            'users.edit',
        ],
    ],
    User::USER_GROUP_ID => [
        'name_en' => 'user',
        'name_ru' => 'поьзователь',
        'permissions' => [
            'users.edit',
            'users.comments',

        ],
    ],
    User::ADMIN_GROUP_ID => [
        'name_en' => 'administrator',
        'name_ru' => 'администратор',
        'permissions' => [
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',
            'anime.update',
            'anime.moderation',
            'anime.create',
        ],
    ],
    User::ANIME_MODER_GROUP_ID => [
        'name_en' => 'anime moderator',
        'name_ru' => 'модератор аниме раздела',
        'permissions' => [
            'users.edit',
            'users.comments',
            'anime.update',
            'anime.moderation',
            'anime.create',
        ],
    ],
    User::MANGA_MODER_GROUP_ID => [
        'name_en' => 'manga moderator',
        'name_ru' => 'модератор раздела манги',
        'permissions' => [
            'users.edit',
            'users.comments',

        ],
    ],
    User::RANOBE_MODER_GROUP_ID => [
        'name_en' => 'light novel moderator',
        'name_ru' => 'модератор раздела ранобэ',
        'permissions' => [
            'users.edit',
            'users.comments',

        ],
    ],
    User::SUPER_MODER_GROUP_ID => [
        'name_en' => 'super moder',
        'name_ru' => 'супер модератор',
        'permissions' => [
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',
            'anime.update',
            'anime.moderation',
            'anime.create',

        ],
    ],
    User::USER_MODER_GROUP_ID => [
        'name_en' => 'users moder',
        'name_ru' => 'модератор пользователей',
        'permissions' => [
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',

        ],
    ],
    User::STEAMER_GROUP_ID => [
        'name_en' => 'blogger',
        'name_ru' => 'блоггер',
        'permissions' => [
            'users.edit',
            'users.comments',

        ],
    ],
];
