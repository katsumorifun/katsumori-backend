# О проекте
Katsumori является платформой с возможностью просмотра аниме, чтением манги и ранобэ, а так же огромной библиотекой визуальных новелл.

Сайт состоит из двух отдельно живущих частей:
- backend - PHP and Laravel
- frontend - VUE.JS

Скриншоты фронтенда:

![ScreenShot](https://i.ibb.co/7r1XFPC/image-2021-12-05-21-30-45.png)
![ScreenShot](https://i.ibb.co/D1HvJvP/image-2021-12-05-21-37-17.png)
![ScreenShot](https://i.ibb.co/zSQJRYq/image-2021-12-05-22-58-02.png)

[Репозиторий фронтенда](https://github.com/katsumorifun/katsumori-frontend)

# Локальная развертка через Docker

В первую очередь надо скачать репозиторий с Github
```shell
$ git clone https://github.com/katsumorifun/katsumori-backend.git
$ cd katsumori-backend
```

После выполнения данного шага нужно собрать образ приложением и установить зависимости
```shell
$ make install
```

Выполнить инициализацию приложения
```shell
$ make init
```

Запустить приложение
```shell
$ make up
```

Создать пользователя
```shell
$ make shell
$ php artisan make:user 3 {email} {user_name} {password}
```
> где 3 - id группы администраторов

Все доступные группы пользователей:
```
GUEST_GROUP_ID = 1;
USER_GROUP_ID = 2;
ADMIN_GROUP_ID = 3;
ANIME_MODER_GROUP_ID = 4;
MANGA_MODER_GROUP_ID = 5;
RANOBE_MODER_GROUP_ID = 6
SUPER_MODER_GROUP_ID = 7;
USER_MODER_GROUP_ID = 8;
STEAMER_GROUP_ID = 9;
```
> Внимание! Все пользователи с не подтвержденной почтой автоматически удаляются по истечению 24 часов с момента регистрации,
> а так же пользователи гостевой группы автоматически отправляются в группу обычных пользователей по истечению 2 суток.
>
> (App\Base\Schedule -> user -> cleanOldEmailVerify and changeUserGroupToUsers)


Готово! Теперь сайт доступен по адресам [127.0.0.1:8080](http://127.0.0.1:8080) для http и [127.0.0.1:8443](https://127.0.0.1:8443) для https.

## Дополнительная информация

### Как смотреть логи?
```shell
$ docker-compose logs -f
```

### Как добавить свою `make` команду?
Добавить ее в `Makefile`, пример:
````
your-command: ## Your command help
	/bin/your/app -goes -here
````
Узнать больше про make можно [здесь](https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents).

### Как выполнить команды Composer/Artisan/PHP ?
По аналогии с регистрацией пользователя на этапе настройки проекта:
````
$ make shell <- заходим в оболочку проекта, после можно выполнять любые нужные команды
$ php artisan <- artisan
$ php <- php
$ composer <- composer
````
