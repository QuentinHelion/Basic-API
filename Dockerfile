FROM php:7.4-apache
WORKDIR /var/www/

COPY src/* ./html/

COPY app.conf /etc/apache2/sites-available/app.conf

RUN docker-php-ext-install pdo_mysql &&\
    a2enmod rewrite &&\
    a2dissite 000-default &&\
    a2ensite app &&\
    service apache2 restart

EXPOSE 80
