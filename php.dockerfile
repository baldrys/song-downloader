FROM php:7.4-fpm

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html
RUN mkdir -p storage/app/public/downloads
RUN chmod -R 775 storage
RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get install -y python python-pip ffmpeg
RUN pip install --upgrade pip
RUN pip install youtube_dl