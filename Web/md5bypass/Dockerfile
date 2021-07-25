FROM php:5.6-fpm-alpine

COPY ./files /var/www/html


EXPOSE 80

WORKDIR /var/www/html
CMD ["php", "-S", "0.0.0.0:80"]