# ==========================================
# Step 1: Build Frontend Assets (Vite)
# ==========================================
FROM node:20-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# ==========================================
# Step 2: Production PHP/Nginx Environment
# ==========================================
FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Install system packages & dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring zip exif pcntl bcmath gd soap

# Get official Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy Vite-compiled public assets from Step 1
COPY --from=node-builder /app/public/build ./public/build

# Install composer production packages
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Explicitly bind PHP-FPM to 127.0.0.1:9000 so Nginx can reach it
RUN echo '[www]\nlisten = 127.0.0.1:9000' > /usr/local/etc/php-fpm.d/zzz-listen.conf

# Set up directories & correct ownership permissions
RUN mkdir -p /run/nginx /var/log/supervisor \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy server & supervisor configurations
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
