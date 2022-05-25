# Использование

В проекте присутствует конфиг Docker для быстрой развертки, для того, чтобы его использовать установите докер:
- Windows https://docs.docker.com/desktop/windows/install/
- Mac https://docs.docker.com/desktop/mac/install/
- Linux https://docs.docker.com/desktop/linux/install/

# Docker

Перед развертыванием docker-а можно прописать прописать переменные среды (ENV) для БД: 
- MYSQL_ROOT_PASSWORD (по умолчанию password)
- MYSQL_PASSWORD (по умолчанию password)
- MYSQL_USER (по умолчанию Laravel)

После можно выполнить данные команды:
- Запуск и сборка docker-compose контейнеров: docker-compose up --build -d yukidub
- Миграция таблицы бд: docker-compose run --rm artisan migrate
- Создание клиента для авторизации пользователей и т.д.:docker-compose run --rm artisan passport:install
- Генерация OpenAPI/Swagger документации: docker-compose run --rm artisan l5-swagger:generate


После выполнения команд можно перейти по адресу http://127.0.0.1:8081.

Порты остальных сервисов докера
- nginx - :8081
- mysql - :3306
- php - :9000
- redis - :6379