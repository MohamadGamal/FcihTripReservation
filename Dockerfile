FROM  php:7-apache
RUN docker-php-ext-install mysqli pdo pod_mysql
RUN a2enmod rewrite
EXPOSE 80