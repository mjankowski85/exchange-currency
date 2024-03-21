FROM php:8.3.4-cli-alpine as php
COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-overrides.ini.template
RUN apk update && apk add ca-certificates && apk add busybox-suid libcap && setcap cap_setgid=ep /bin/busybox; \
update-ca-certificates;
RUN set -eux; \
mkdir /opt/app/;
EXPOSE 9000
WORKDIR /opt/app/

FROM php as builder
RUN apk update
RUN apk --no-cache add curl
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN set -eux; \
composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"
CMD ["tail", "-f", "/dev/null"]

FROM builder as php_app_dev
ARG USER_ID=1000
ARG GROUP_ID=1000
ARG USER_NAME=dev
ARG GROUP_NAME=dev

RUN addgroup -g $GROUP_ID $GROUP_NAME && \
    adduser --shell /sbin/nologin --disabled-password --uid $USER_ID --ingroup $GROUP_NAME $USER_NAME; \
    chown -R $USER_NAME:$GROUP_NAME $HOME/.composer

RUN apk --update --no-cache add autoconf linux-headers g++ make && \
  pecl install -f xdebug && \
  docker-php-ext-enable xdebug && \
  apk del --purge autoconf g++ make
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#potem się pobawię, problem z phpstan-pro
#ENV PHPSTAN_PRO_WEB_PORT=11111
#EXPOSE 11111
#RUN mkdir /tmp/phpstan-fixer
#RUN chown -R dev:dev /tmp/phpstan-fixer

USER $USER_NAME
