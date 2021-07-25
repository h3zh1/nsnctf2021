FROM ctftraining/base_image_nginx_mysql_php_56

COPY ./files /tmp/
RUN cp -rf /tmp/html/ /var/www/ \
    && cp -f /tmp/flag.sh /flag.sh \
    && chown -R www-data:www-data /var/www/html