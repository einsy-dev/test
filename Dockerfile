FROM php:8.2-apache
WORKDIR /var/www/html
RUN apt-get update -y
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
EXPOSE 80