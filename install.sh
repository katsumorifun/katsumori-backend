#!/bin/bash
# Copyright (c) YukiDub. Author: M. Daniil <den4ic2001@gmail.com>.

# Copy .env file
echo -en "Coping env file"
echo -en "\n"
cp src/.env.example src/.env

echo -en "Database password (default: password):"

read db_password
size=${#db_password}

if ((size > 0));then
  export MYSQL_PASSWORD=$db_password &&
  sed -i "s/DB_PASSWORD=/DB_PASSWORD=$db_password/" src/.env
fi

echo -en "Database user (default: laravel):"

read mysql_user
size=${#mysql_user}

if ((size > 0));then
  export MYSQL_USER=$mysql_user &&
  sed -i "s/DB_USERNAME=/DB_USERNAME=$mysql_user/" src/.env
fi

read elastic_password
size=${#elastic_password}

if ((size > 0));then
  export ELASTIC_PASSWORD=elastic_password &&
  sed -i "s/ELASTIC_PASSWORD=/ELASTIC_PASSWORD=$elastic_password/" src/.env
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