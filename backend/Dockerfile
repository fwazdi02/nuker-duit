# Dockerfile for Laravel backend

# Use the official PHP 7.4 image as the base image
FROM php:7.4-fpm

# Set working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy and install Laravel dependencies
COPY backend/composer.json backend/composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY backend .

# Generate autoload files
RUN composer dump-autoload

# Create necessary directories
RUN mkdir -p storage bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# # Expose port 9999 and start PHP-FPM
# EXPOSE 9000
# CMD ["php-fpm"]
