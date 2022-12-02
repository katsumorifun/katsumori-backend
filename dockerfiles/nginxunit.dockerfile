FROM nginx/unit:1.27.0-php8.1

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

WORKDIR /var/www/html

ADD ./configs/php/php.ini /usr/local/etc/php8/php.ini

RUN addgroup --gid ${UID} laravel; \
  adduser --uid ${UID} --gid ${UID} --disabled-password laravel; \
  adduser laravel laravel;

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd xdebug

#RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql
# apcu apcu_bc
# надо проверить работоспособность GD загрузив например аватарку пользователю, либо постер анимехе

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.3.4.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

CMD ["unitd","--no-daemon","--control","0.0.0.0:8080"]