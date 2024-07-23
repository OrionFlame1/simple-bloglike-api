# Use the official PHP image as a base image
FROM php:8.2.7-apache

# Install necessary PHP extensions and tools
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    apt-get update && \
    apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application source code to the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80

# Set the entrypoint for the container
CMD ["apache2-foreground"]
