# О проекте
YukiDub (скоро название сменится) - сайт, являющийся библиотекой аниме, манги, ранобэ, визуальных новелл с возможностью просмотра аниме, чтения ранобэ и манги, а так же скачиванием визуальных новелл.

Сайт состоит из двух частей, бэкенда(PHP + Laravel) и фронтенда (VUE.JS).

Скриншоты фронтенда:

![ScreenShot](https://i.ibb.co/7r1XFPC/image-2021-12-05-21-30-45.png)
![ScreenShot](https://i.ibb.co/D1HvJvP/image-2021-12-05-21-37-17.png)
![ScreenShot](https://i.ibb.co/zSQJRYq/image-2021-12-05-22-58-02.png)

[Репозиторий фронтенда](https://github.com/YukiDub/yukidub-frontend)
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

Во время выполнения скрипт даст возможность ввести пароль для базы данных и т.д., после его выполнения перейтиде по адресу 
http://127.0.0.1:8081

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


После выполнения команд можно перейти по адресу http://127.0.0.1:8081.

Порты снаружи/внутри докера
- nginx - 8081:8081
- mysql - 3306:3306
- php - 9000:9000
- redis - 6379:6379

Ссылка на документацию к API: http://127.0.0.1:8081/api/documentation

### [Code style и другие рекомендации](https://github.com/YukiDub/php-conventions)