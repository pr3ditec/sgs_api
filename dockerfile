# Use the official PHP 8.3 image as the base image
FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && apt-get clean

# Set memory limit for PHP
RUN echo "memory_limit=1G" > /usr/local/etc/php/conf.d/memory-limit.ini

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy all files from the current directory to /var/www in the container
COPY . /var/www

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# Clear Composer cache
RUN composer clear-cache

# Install Laravel dependencies
# RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --no-scripts -vvv
RUN composer install

# Expose port 8000 for the Laravel server
EXPOSE 8000

# Start Laravel development server
CMD php artisan migrate && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000