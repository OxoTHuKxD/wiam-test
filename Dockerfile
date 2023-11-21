FROM php:8.2-fpm-alpine3.18

WORKDIR /application

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    postgresql-dev \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -rf composer-setup.php \
    && docker-php-ext-install pdo_pgsql

COPY ./environment-config/prod/php/php-ini-overrides.ini /usr/local/etc/php/conf.d/php.ini

COPY --chown=nobody:nobody ./composer* ./

RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --optimize-autoloader \
    && chown -R nobody:nobody /application

COPY --chown=nobody:nobody . /application

USER nobody