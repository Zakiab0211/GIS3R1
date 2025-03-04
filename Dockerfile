# # Use the official PHP image as a base image
# FROM php:8.1-fpm

# # Set working directory
# WORKDIR /var/www

# # Install system dependencies
# RUN apt-get update && apt-get install -y \
#     build-essential \
#     libpng-dev \
#     libjpeg-dev \
#     libfreetype6-dev \
#     locales \
#     zip \
#     jpegoptim optipng pngquant gifsicle \
#     vim \
#     unzip \
#     git \
#     curl \
#     libzip-dev \
#     libpq-dev \
#     libonig-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd

# # Install PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# # Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# # Install Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Copy the existing application directory contents to the working directory
# COPY . /var/www

# # Copy the existing application directory permissions to the working directory
# COPY --chown=www-data:www-data . /var/www

# # Change current user to www
# USER www-data

# # Set permissions for storage and cache directories
# # Set permissions for storage and cache directories
# RUN chown -R www-data:www-data /var/www/storage \
#     && chown -R www-data:www-data /var/www/bootstrap/cache \
#     && chmod -R 775 /var/www/storage \
#     && chmod -R 775 /var/www/bootstrap/cache


# # Expose port 9000 and start php-fpm server
# EXPOSE 9000
# CMD ["php-fpm"]

# Gunakan PHP 8.1 sebagai base image
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl \
    && docker-php-ext-enable opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel Project
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Set the default command
CMD ["php-fpm"]
