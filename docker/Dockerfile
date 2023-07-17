FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
            git \
            curl \
            libpng-dev \
            libonig-dev \
            libxml2-dev \
            zip \
            unzip \
            libpq-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/nginx/default.conf /etc/nginx/conf.d/

RUN useradd --no-create-home -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html

USER $user
