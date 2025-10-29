FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libsqlite3-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libpq-dev \
    libmagickwand-dev \
    --no-install-recommends \
    && rm -r /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        pdo_sqlite \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        intl \
        zip \
        pdo_pgsql \
        opcache \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy existing application directory
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev --no-scripts --no-interaction
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Expose port
EXPOSE 8000

# Start server (migrations should be run manually via console)
CMD php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
