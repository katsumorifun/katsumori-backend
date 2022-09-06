# О проекте
YukiDub (скоро название сменится) - сайт являющийся библиотекой аниме, манги, ранобэ, визуальных новелл с возможностью просмотра аниме, чтения ранобэ и манги, а так же скачиванием визуальных новелл.

# Использование

В проекте присутствует конфиг Docker для быстрой развертки для его использования установите докер:
- Windows: https://docs.docker.com/desktop/windows/install/
- Mac: https://docs.docker.com/desktop/mac/install/
- Ubuntu: https://docs.docker.com/engine/install/ubuntu/

# Docker

## Быстрая установка на Linux

Откройте командную строку и запустите bash скрипт:
```
./install.sh
```

## Ручная установка

Перед развертыванием docker-а можно прописать переменные среды (ENV) для БД: 
- MYSQL_ROOT_PASSWORD (по умолчанию password)
- MYSQL_PASSWORD (по умолчанию password)
- MYSQL_USER (по умолчанию Laravel)

Пример на Linux:
````
export MYSQL_ROOT_PASSWORD=password
````

После можно выполнить данные команды:
- Запуск и сборка docker-compose контейнеров: ````docker-compose up --build -d yukidub````
- Установка всех зависимостей Composer: ````docker-compose run --rm composer install````
- Миграция таблицы бд: ````docker-compose run --rm artisan migrate````
- Миграция таблицы бд: ````docker-compose run --rm artisan key:generate````
- Создание клиента для авторизации пользователей и т.д.: ````docker-compose run --rm artisan passport:install````
- Генерация OpenAPI/Swagger документации: ````docker-compose run --rm artisan l5-swagger:generate````


После выполнения команд можно перейти по адресу http://127.0.0.1:8081.

Порты снаружи/внутри докера
- nginx - 8081:8081
- mysql - 3306:3306
- php - 9000:9000
- redis - 6379:6379