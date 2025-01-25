# Use an official PHP runtime as a parent image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Verify Node.js and npm installation
RUN node --version && npm --version

# Copy existing application directory contents
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Create .npm directory for the www-data user
RUN mkdir -p /var/www/.npm && chown -R www-data:www-data /var/www/.npm

# Switch to www-data user
USER www-data

# Install Laravel dependencies
RUN composer install

# Install Vue.js dependencies
RUN HOME=/var/www npm install --verbose

# Build Vue.js application
RUN HOME=/var/www npm run build

# Switch back to root for operations that might need elevated permissions
USER root

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]