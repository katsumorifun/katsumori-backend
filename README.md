# О проекте
Katsumori - это платформа с возможностью просмотра аниме, чтением манги и ранобэ, а так же огромной библиотекой визуальных новелл.

Сайт состоит из двух частей - бэкенда(PHP + Laravel) и фронтенда (VUE.JS).

Скриншоты фронтенда:

![ScreenShot](https://i.ibb.co/7r1XFPC/image-2021-12-05-21-30-45.png)
![ScreenShot](https://i.ibb.co/D1HvJvP/image-2021-12-05-21-37-17.png)
![ScreenShot](https://i.ibb.co/zSQJRYq/image-2021-12-05-22-58-02.png)

[Репозиторий фронтенда](https://github.com/katsumorifun/katsumori-frontend)
# Использование

В проекте присутствует конфиг Docker для быстрой развертки.
- Windows: https://docs.docker.com/desktop/windows/install/
- Mac: https://docs.docker.com/desktop/mac/install/
- Ubuntu: https://docs.docker.com/engine/install/ubuntu/

## Docker

### Быстрая развертка под Linux в Docker

Откройте командную строку и запустите bash скрипт:
```
./install.sh
```

Во время выполнения скрипт даст возможность ввести пароль для базы данных и т.д., так же, на экарне будет выведена запись типа


`Personal access client created successfully.`

`Client ID: 1`

`Client secret: generated client secret`

`Password grant client created successfully.`

`Client ID: 2`

`Client secret: generated client secret`

Скопируйте секретный ключ клиента паролей (`Client secret`) и запишите его в фай .env в поле `PASSPORT_PASSWORD_GRANT_CLIENT_SECRET` 

После выполнения всех действий сайт будет доступен по адресу: http://127.0.0.1:8081

### Ручная развертка  в Docker

Перед развертыванием docker-а можно прописать переменные среды (ENV) для БД: 
- MYSQL_ROOT_PASSWORD (по умолчанию password)
- MYSQL_PASSWORD (по умолчанию password)
- MYSQL_USER (по умолчанию Laravel)
- ELASTIC_PASSWORD (по умолчанию password)

Пример на Linux:
````
export MYSQL_ROOT_PASSWORD=password
````

После можно выполнить данные команды:
- Запуск и сборка docker-compose контейнеров: ````docker-compose up --build -d yukidub````
- Установка всех зависимостей Composer: ````docker-compose run --rm composer install````
- Миграция таблицы бд: ````docker-compose run --rm artisan migrate````
- Генерация ключей passport: ````docker-compose run --rm artisan key:generate````
- Генерация OpenAPI/Swagger документации: ````docker-compose run --rm artisan l5-swagger:generate````
- Индексация всех записей для Elasticsearch (если они есть в бд): ````docker-compose run --rm artisan search:reindex````


При генерации ключей для passport будет выведенно сообщение такого рода

`Personal access client created successfully.`

`Client ID: 1`

`Client secret: generated client secret`

`Password grant client created successfully.`

`Client ID: 2`

`Client secret: generated client secret`

Скопируйте секретный ключ клиента паролей (`Client secret`) и запишите его в фай .env в поле `PASSPORT_PASSWORD_GRANT_CLIENT_SECRET`

После выполнения команд можно перейти по адресу http://127.0.0.1:80.

# Настройка после запуска проекта

### Создание пользователя
Для создания пользователя с правами администратора выполните команду:
``docker-compose run --rm artisan make:user 3 {email} {user_name} {password}``
где 3 - id группы admin.

Все доступные группы:
`GUEST_GROUP_ID = 1;
USER_GROUP_ID = 2;
ADMIN_GROUP_ID = 3;
ANIME_MODER_GROUP_ID = 4;
MANGA_MODER_GROUP_ID = 5;
RANOBE_MODER_GROUP_ID = 6
SUPER_MODER_GROUP_ID = 7;
USER_MODER_GROUP_ID = 8;
STEAMER_GROUP_ID = 9;`

### Создание индексов для поиска 
Для создания индексов выполните команду ``docker-compose run --rm artisan search:index``

Если не создать индексы, то в дальнейшем возникнут проблемы с работой поисковика.


# Порты снаружи/внутри докера
- nginx unit - 8081:8081 (site), 8080 (api unit)
- mysql - 3306:3306
- php - 9000:9000
- redis - 6379:6379
- elasticsearch - 9200:9200, 9300:9300

Ссылка на документацию к API: http://127.0.0.1:80/api/documentation

### [Code style и другие рекомендации](https://github.com/YukiDub/php-conventions)