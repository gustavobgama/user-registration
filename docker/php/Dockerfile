FROM php:7.2.10-fpm-alpine3.8

LABEL maintainer "Gustavo Gama <gustavobgama@gmail.com>"

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories
RUN apk update && apk --no-cache add \
  openssh-client \
  shadow \
  build-base \
  zlib-dev \
  libxml2-dev \
  autoconf

RUN docker-php-ext-install \
  pdo_mysql \
  bcmath \
  zip \
  soap \
  pcntl

RUN php -r "readfile('https://getcomposer.org/installer');" | php && \
   mv composer.phar /usr/bin/composer && \
   chmod +x /usr/bin/composer

ENV DOCKERIZE_VERSION v0.6.1
RUN curl -O -sL https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

WORKDIR /opt/app

CMD ./docker/php/start.sh