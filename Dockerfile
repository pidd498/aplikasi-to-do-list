FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data storage bootstrap/cache

CMD php artisan migrate --force && supervisord -c /etc/supervisor/conf.d/supervisord.conf