FROM php:8.2-apache

# Enable cURL
RUN docker-php-ext-install curl

# Copy project files
COPY . /var/www/html/

# Set permissions for logs
RUN mkdir -p /var/www/html/log && \
    touch /var/www/html/log/events.log && \
    chown -R www-data:www-data /var/www/html/log

EXPOSE 80
