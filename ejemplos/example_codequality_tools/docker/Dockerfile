# Production Stage
FROM php:8.3-alpine

# Install utils
RUN apk update && apk add bash iputils-ping

# Install php extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions @composer xdebug

# Create a user for running the app
RUN addgroup appgroup && adduser -S -G appgroup appuser
USER appuser

# Install code quality tools && sample app
RUN cd /var/www/html && composer init --name=vendor/app \
    && composer require --dev phpunit/phpunit ^9.6 \
    && composer require --dev phpstan/phpstan \
    && composer require --dev squizlabs/php_codesniffer \
    && composer require --dev friendsofphp/php-cs-fixer
COPY --chown=appuser:appgroup ./docker/.php-cs-fixer.php /var/www/html/
COPY --chown=appuser:appgroup ./docker/.phpcs.xml /var/www/html/
COPY --chown=appuser:appgroup ./app/main.php /var/www/html/

WORKDIR /var/www/html
CMD tail -f /dev/null
