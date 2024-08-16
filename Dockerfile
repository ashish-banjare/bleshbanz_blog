FROM php:7.3-fpm

# Argument defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
      git \
      curl \
      libpng-dev \
      libonig-dev \
      libxml2-dev \
      libzip-dev \
      zip \
      unzip



# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# clear cache
RUN apt-get clean && rm -rf /var/lib/apt/list/*

#install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip pcntl

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/ .composer && \
      chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user