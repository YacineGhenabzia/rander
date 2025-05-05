FROM php:8.1-apache

# تثبيت الحزم المطلوبة لامتدادات PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pgsql pdo_pgsql

# تفعيل mod_rewrite
RUN a2enmod rewrite
COPY src/ /var/www/html/
RUN docker-php-ext-install mysqli
