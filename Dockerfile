FROM php:8.2-fpm
RUN apt-get update && apt-get install -y sqlite3 php8.2-sqlite
WORKDIR /var/www/html
COPY . .

CMD ["php-fpm"]
