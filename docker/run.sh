#!/bin/sh

mkdir -p /var/nginx/client_body_temp
chown nobody:nobody /sessions /var/nginx/client_body_temp
mkdir -p /var/run/php/
chown nobody:nobody /var/run/php/
touch /var/log/php-fpm.log
chown nobody:nobody /var/log/php-fpm.log

# SET APP_MODE to template
if [ "$APP_MODE" != "frontend" ]; then
    APP_MODE=backend
fi
envsubst '$$APP_MODE' < /etc/nginx.template > /etc/nginx.conf;

if [ "$1" = 'www' ]; then
    exec supervisord --nodaemon --configuration="/etc/supervisord.conf" --loglevel=info
fi