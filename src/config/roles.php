<?php

use App\Models\User;

return [
    User::GUEST_GROUP_ID => array(
        'name_en' => 'guest',
        'name_ru' => 'гость',
        'permissions' => array(
            'users.edit',
        )
    ),
    User::USER_GROUP_ID => array(
        'name_en' => 'user',
        'name_ru' => 'поьзователь',
        'permissions' => array(
            'users.edit',
            'users.comments',

        )
    ),
    User::ADMIN_GROUP_ID => array(
        'name_en' => 'administrator',
        'name_ru' => 'администратор',
        'permissions' => array(
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',
            'anime.update',
            'anime.moderation',
            'anime.create',
        )
    ),
    User::ANIME_MODER_GROUP_ID => array(
        'name_en' => 'anime moderator',
        'name_ru' => 'модератор аниме раздела',
        'permissions' => array(
            'users.edit',
            'users.comments',
            'anime.update',
            'anime.moderation',
            'anime.create',
        )
    ),
    User::MANGA_MODER_GROUP_ID => array(
        'name_en' => 'manga moderator',
        'name_ru' => 'модератор раздела манги',
        'permissions' => array(
            'users.edit',
            'users.comments',

        )
    ),
    User::RANOBE_MODER_GROUP_ID => array(
        'name_en' => 'light novel moderator',
        'name_ru' => 'модератор раздела ранобэ',
        'permissions' => array(
            'users.edit',
            'users.comments',

        )
    ),
    User::SUPER_MODER_GROUP_ID => array(
        'name_en' => 'super moder',
        'name_ru' => 'супер модератор',
        'permissions' => array(
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',
            'anime.update',
            'anime.moderation',
            'anime.create',

        )
    ),
    User::USER_MODER_GROUP_ID => array(
        'name_en' => 'users moder',
        'name_ru' => 'модератор пользователей',
        'permissions' => array(
            'users.edit',
            'users.comments',
            'users.admin.block.comments',
            'users.admin.ban',
            'users.admin.edit',

        )
    ),
    User::STEAMER_GROUP_ID => array(
        'name_en' => 'blogger',
        'name_ru' => 'блоггер',
        'permissions' => array(
            'users.edit',
            'users.comments',

        )
    ),
];
