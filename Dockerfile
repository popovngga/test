FROM php:8.4-fpm-bullseye

ARG USER_UID=1001
ARG USER_GID=1001

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libxml2-dev \
    libonig-dev \
    gettext-base \
    && docker-php-ext-install pdo_mysql zip mbstring xml bcmath \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupmod -g ${USER_GID} www-data && usermod -u ${USER_UID} -g ${USER_GID} www-data

WORKDIR /var/www/html

COPY --chown=www-data:www-data composer.json composer.lock package.json ./
RUN composer install --no-dev --no-autoloader
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && npm install

COPY --chown=www-data:www-data . .

COPY ./docker/php/php.ini.template /usr/local/etc/php/conf.d/php.ini.template
COPY ./docker/php/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R ug+rwX /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /usr/local/etc/php/conf.d/
RUN chown -R www-data:www-data /var/www/html/node_modules
RUN chown -R www-data:www-data /var/www/html/vendor

USER www-data

ENTRYPOINT ["docker-entrypoint.sh"]
