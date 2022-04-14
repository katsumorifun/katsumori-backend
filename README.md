#Использование

В проекте присутствует конфиг Docker для быстрой развертки, для того, чтобы его использовать установите докер:
- Windows https://docs.docker.com/desktop/windows/install/
- Mac https://docs.docker.com/desktop/mac/install/
- Linux https://docs.docker.com/desktop/linux/install/

#Docker
Перед развертыванием docker-а надо прописать переменные (ENV) для БД: 
- MYSQL_ROOT_PASSWORD
- MYSQL_PASSWORD
- MYSQL_USER

После можно выполнить данные команды:
- docker-compose --build -d yukidub
- docker-compose run --rm artisan migrate
- docker-compose run --rm artisan passport:install (создание клиента для авторизации пользователей и т.д.)
- docker-compose run --rm artisan l5-swagger:generate (генерация OpenAPI/Swagger документации)


После выполнения команд можно перейти по адресу http://127.0.0.1:8081.

Порты остальных сервисов докера
- nginx - :8081
- mysql - :3306
- php - :9000
- redis - :6379