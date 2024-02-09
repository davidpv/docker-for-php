FROM php:8.3-fpm-alpine as base

# UTILS HTOP
FROM alpine:3.14 as build
#RUN apk update && apk --no-cache add build-base git ncurses-dev autoconf automake libtool
#WORKDIR /src
#RUN git clone https://github.com/htop-dev/htop.git
#RUN cd htop && ./autogen.sh 2>&1 && \
#   ./configure 2>&1 && \
#   make 2>&1

# BASE PHP
FROM base as php
#COPY --from=build /src/htop/htop /bin/htop
RUN apk update && apk add bash git iputils

# symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
COPY ./docker/php/install.sh /install.sh

# php extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions @composer
RUN install-php-extensions ctype iconv session SimpleXML Tokenizer

# add user
RUN addgroup appgroup && adduser -S -G appgroup appuser
USER appuser

# BASE PHP FOR DEVELOPMENT
FROM php as php-dev
USER root
RUN install-php-extensions xdebug
USER appuser
WORKDIR /var/www/html
RUN composer require --dev phpunit/phpunit ^9.6 \
    && composer require --dev phpstan/phpstan \
    && composer require --dev squizlabs/php_codesniffer \
    && composer require --dev friendsofphp/php-cs-fixer



# BASE PHP FOR PRODUCTION DEPLOYMENT
FROM php as php-prod
USER appuser
COPY --chown=appuser ./project/ /var/www/html/
RUN rm -rf /var/www/html/vendor \
    && composer install --no-dev --optimize-autoloader --no-interaction \
    && composer dump-autoload --optimize --no-dev \
    && php bin/console cache:clear --env=prod --no-debug

WORKDIR /var/www/html
