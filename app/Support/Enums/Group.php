<?php

namespace App\Support\Enums;

enum Group: int
{
    case GUEST_GROUP_ID = 1;
    case USER_GROUP_ID = 2;
    case ADMIN_GROUP_ID = 3;
    case ANIME_MODER_GROUP_ID = 4;
    case MANGA_MODER_GROUP_ID = 5;
    case RANOBE_MODER_GROUP_ID = 6;
    case SUPER_MODER_GROUP_ID = 7;
    case USER_MODER_GROUP_ID = 8;
    case STEAMER_GROUP_ID = 9;
}
