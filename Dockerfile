FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

EXPOSE 8000

CMD ["sh", "-c", "cp -n .env.example .env && composer update --no-interaction && { grep -q '^APP_KEY=$' .env && php artisan key:generate --force || true; } && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]
