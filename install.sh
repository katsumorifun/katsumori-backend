#!/bin/bash
# Copyright (c) YukiDub. Author: M. Daniil <den4ic2001@gmail.com>.

echo -en "Database password (default: password):"

read db_password
size=${#db_password}

if ((size > 0));then
  export MYSQL_PASSWORD=$db_password
fi

echo -en "Database user (default: laravel):"

read mysql_user
size=${#mysql_user}

if ((size > 0));then
  export MYSQL_USER=$mysql_user
fi

echo -en "Database root password (default: password):"

read root_password
size=${#root_password}

if ((size > 0));then
  export MYSQL_ROOT_PASSWORD=$root_password
fi

#Build project
echo -en "\033[37;1;41m Building project \033[0m" &&
echo -en "\n" &&
docker-compose up --build -d yukidub &&

#Composer install
echo -en "\033[37;1;41m Composer install \033[0m" &&
echo -en "\n" &&
docker-compose run --rm composer install &&

#Generate key
echo -en "\033[37;1;41m Database migrations \033[0m" &&
echo -en "\n" &&
docker-compose run --rm artisan key:generate &&

echo -en "\033[37;1;41m Sleep 5 second \033[0m" &&
sleep 5s

#Database migrations
echo -en "\033[37;1;41m Database migrations \033[0m" &&
echo -en "\n" &&
docker-compose run --rm artisan migrate &&

#Passport installation
echo -en "\033[37;1;41m Passport installation \033[0m" &&
echo -en "\n" &&
docker-compose run --rm artisan passport:install &&

#Swagger generate
echo -en "\033[37;1;41m Swagger generate \033[0m" &&
echo -en "\n" &&
docker-compose run --rm artisan l5-swagger:generate