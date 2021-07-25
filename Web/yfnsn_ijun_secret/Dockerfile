FROM php:7.3-fpm-alpine

LABEL Organization="hbu_yfnsn" Author="kee1ongz & h3zh1 & kevin_bruce & mcsige"

MAINTAINER Virink@CTFTraining <virink@outlook.com>

COPY _files /tmp/
COPY src /var/www/html


RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories \
    && apk add --update --no-cache nginx \
    && apk add curl bash \
    && apk add php7-mbstring php7-json php7-session php7-fpm php7-curl php7-posix php7-fileinfo \
    ##&& mkdir /run/nginx \
    ##install ssh & create a user ciscn.User group is ciscn and password is bzXunj5W
    && apk add --no-cache openssh tzdata  \ 
    && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime  \
    && sed -i "s/#PermitRootLogin.*/PermitRootLogin yes/g" /etc/ssh/sshd_config  \
    && ssh-keygen -t dsa -P "" -f /etc/ssh/ssh_host_dsa_key  \
    && ssh-keygen -t rsa -P "" -f /etc/ssh/ssh_host_rsa_key  \
    && ssh-keygen -t ecdsa -P "" -f /etc/ssh/ssh_host_ecdsa_key  \
    && ssh-keygen -t ed25519 -P "" -f /etc/ssh/ssh_host_ed25519_key  \
    && adduser ciscn -g www-data -D \
    && echo 'ciscn:bzXunj5W' | chpasswd \
    # configure file
    && mv /tmp/wHaT_y0u_wAnt_1s_fl4gggg.txt /wHaT_y0u_wAnt_1s_fl4gggg.txt \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && mv /tmp/nginx.conf /etc/nginx/nginx.conf \
    && mv /tmp/php.ini /usr/local/etc/php/ \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html \
    # clear
    && rm -rf /tmp/*

WORKDIR /var/www/html

EXPOSE 80 22

VOLUME ["/var/log/nginx"]

CMD ["/bin/bash", "-c", "docker-php-entrypoint"]
