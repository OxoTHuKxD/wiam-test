#!/usr/bin/env bash

cp -u .env-prod.example .env-prod

docker build -t wiam-test-base-php .

docker-compose -f docker-compose-prod.yml build
docker-compose -f docker-compose-prod.yml up -d
docker-compose -f docker-compose-prod.yml run wiam-prod-app php yii migrate --interactive=0