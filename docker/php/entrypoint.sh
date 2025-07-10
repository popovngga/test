#!/bin/sh
set -e

envsubst < /usr/local/etc/php/conf.d/php.ini.template > /usr/local/etc/php/conf.d/php.ini

for i in $(seq 1 10); do
  if php artisan migrate:status >/dev/null 2>&1; then
    break
  fi
  echo "Waiting for DB... ($i)"
  sleep 1
done

composer dump-autoload --optimize
php artisan migrate --force --no-interaction
php artisan optimize

npm run dev & php-fpm
