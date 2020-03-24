FROM alpine:3.6

RUN apk add --update \
    php7-fpm \
    php7-mcrypt \
    php7-mbstring \
    php7-opcache \
    php7-openssl \
    php7-pdo \
    php7-pdo_mysql \
    php7-mysqli \
    php7-xml \
    php7-zlib \
    php7-phar \
    php7-tokenizer \
    php7-session \
    make \
    curl \
    php7-curl \
    php7-json \
    php7-dom \
    php7-xmlwriter

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

ADD application.ini /etc/php7/php-fpm.d/
ADD application.ini /etc/php7/cli/conf.d/

ADD application.pool.conf /etc/php7/php-fpm.d/

CMD ["php-fpm7", "-F"]

WORKDIR /var/www/application
EXPOSE 9000
