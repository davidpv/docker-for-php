FROM php:8.3-alpine

WORKDIR /var/www/html

# Install php extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions
RUN install-php-extensions @composer


# Create a user for running the app
RUN addgroup appgroup && adduser -S -G appgroup appuser
USER appuser

COPY composer*.json ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-progress
COPY . .

EXPOSE 9000
CMD ["php-fpm"]