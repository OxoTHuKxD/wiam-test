#!/usr/bin/env bash

cp -u .env.example .env
cp -u environment-config/dev/nginx/default.nginx environment-config/dev/nginx/default.local.nginx
cp -u environment-config/dev/php/php-ini-overrides.ini environment-config/dev/php/php-ini-overrides.local.ini

docker build -t wiam-test-base-php .
docker-compose build
docker-compose run wiam-app composer install --prefer-dist --optimize-autoloader
docker-compose run wiam-app php yii migrate
docker-compose up -d