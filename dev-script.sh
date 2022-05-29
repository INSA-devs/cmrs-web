#!/bin/bash

cp cmrs-api/.env.example cmrs-api/.env

git submodule update --force --recursive --init --remote

cd laradock

cp .env.example .env

# TODO: since this config as string is not working must change the path mannualy before building 
# APP_CODE_PATH_HOST=../cmrs-api
# sed -i "s/^APP_CODE_PATH_HOST.*/APP_CODE_PATH_HOST=${APP_CODE_PATH_HOST}/" .env

COMPOSE_PROJECT_NAME=CMRS
sed -i "s/^COMPOSE_PROJECT_NAME.*/COMPOSE_PROJECT_NAME=${COMPOSE_PROJECT_NAME}/" .env

PHP_VERSION=8.1
sed -i "s/^PHP_VERSION.*/PHP_VERSION=${PHP_VERSION}/" .env

WORKSPACE_INSTALL_SUPERVISOR=true
sed -i "s/^WORKSPACE_INSTALL_SUPERVISOR.*/WORKSPACE_INSTALL_SUPERVISOR=${WORKSPACE_INSTALL_SUPERVISOR}/" .env

WORKSPACE_NODE_VERSION=16.13
sed -i "s/^WORKSPACE_NODE_VERSION.*/WORKSPACE_NODE_VERSION=${WORKSPACE_NODE_VERSION}/" .env

WORKSPACE_INSTALL_FFMPEG=true
sed -i "s/^WORKSPACE_INSTALL_FFMPEG.*/WORKSPACE_INSTALL_FFMPEG=${WORKSPACE_INSTALL_FFMPEG}/" .env

WORKSPACE_INSTALL_IMAGEMAGICK=true
sed -i "s/^WORKSPACE_INSTALL_IMAGEMAGICK.*/WORKSPACE_INSTALL_IMAGEMAGICK=${WORKSPACE_INSTALL_IMAGEMAGICK}/" .env

PHP_FPM_INSTALL_MEMCACHED=true
sed -i "s/^PHP_FPM_INSTALL_MEMCACHED.*/PHP_FPM_INSTALL_MEMCACHED=${PHP_FPM_INSTALL_MEMCACHED}/" .env

PHP_FPM_INSTALL_EXIF=true
sed -i "s/^PHP_FPM_INSTALL_EXIF.*/PHP_FPM_INSTALL_EXIF=${PHP_FPM_INSTALL_EXIF}/" .env

PHP_FPM_FFMPEG=true
sed -i "s/^PHP_FPM_FFMPEG.*/PHP_FPM_FFMPEG=${PHP_FPM_FFMPEG}/" .env

PHP_FPM_INSTALL_IMAGEMAGICK=true
sed -i "s/^PHP_FPM_INSTALL_IMAGEMAGICK.*/PHP_FPM_INSTALL_IMAGEMAGICK=${PHP_FPM_INSTALL_IMAGEMAGICK}/" .env

WORKSPACE_INSTALL_MYSQL_CLIENT=true
sed -i "s/^WORKSPACE_INSTALL_MYSQL_CLIENT.*/WORKSPACE_INSTALL_MYSQL_CLIENT=${WORKSPACE_INSTALL_MYSQL_CLIENT}/" .env

# nginx/nginx.conf
keepalive_timeout=120;
sed -i "s/keepalive_timeout.*/keepalive_timeout ${keepalive_timeout};/" nginx/nginx.conf

client_max_body_size=100M;
sed -i "s/client_max_body_size.*/client_max_body_size ${client_max_body_size};/" nginx/nginx.conf

# php-fpm/laravel.ini
memory_limit=500M
sed -i "s/^memory_limit.*/memory_limit = ${memory_limit}/" php-fpm/laravel.ini

upload_max_filesize=200M
sed -i "s/^upload_max_filesize.*/upload_max_filesize = ${upload_max_filesize}/" php-fpm/laravel.ini

post_max_size=200M
sed -i "s/^post_max_size.*/post_max_size = ${post_max_size}/" php-fpm/laravel.ini

docker-compose down

docker-compose build --no-cache nginx mysql redis meilisearch mailhog phpmyadmin php-fpm workspace
# docker-compose build --no-cache php-fpm workspace

docker-compose up -d nginx mysql redis meilisearch mailhog phpmyadmin redis-webui

docker-compose exec workspace composer install 

docker-compose exec workspace npm run dev

docker-compose exec workspace php artisan migrate:fresh --seed

docker-compose exec workspace php artisan storage:link