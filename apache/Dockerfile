FROM php:5.5.38-apache
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        php5-mysql \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www

#RUN chmod -R 0755 /var/www/html/code/uploads/

