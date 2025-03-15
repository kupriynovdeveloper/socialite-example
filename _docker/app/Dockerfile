# Production stage
FROM php:8.2-fpm

ARG USER_ID=1000
ARG GROUP_ID=1000

# Install dependencies
RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        apt-utils \
        libpq-dev \
        libpng-dev \
        libzip-dev \
        zip \
        unzip \
        git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP extensions
RUN docker-php-ext-install \
    bcmath \
    gd \
    zip \
    pdo \
    pdo_mysql

#Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Create non-root user
RUN groupadd -g ${GROUP_ID} appuser \
    && useradd -u ${USER_ID} -g appuser -m appuser \
    && mkdir -p /var/www \
    && chown -R appuser:appuser /var/www

# Security configurations
COPY ./_docker/app/conf.d/* $PHP_INI_DIR/conf.d

# Настройка PHP-FPM в файле www.conf для работы только с определенных IP
COPY ./_docker/app/conf.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# Configure PHP-FPM
RUN sed -i 's/user = www-data/user = appuser/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/group = www-data/group = appuser/g' /usr/local/etc/php-fpm.d/www.conf \
    && ln -sf /dev/stdout /var/log/php-fpm.access.log \
    && ln -sf /dev/stderr /var/log/php-fpm.error.log

# Create log files
RUN mkdir -p /var/log && \
    touch /var/log/php-fpm.access.log && \
    chown appuser:appuser /var/log/php-fpm.access.log  && \
    chown -R appuser:appuser /var/log

WORKDIR /var/www

# предоставить пользователю appuser разрешение на запись в /usr/local/bin
RUN chown appuser:appuser /usr/local/bin

# Set permissions
RUN chown -R appuser:appuser /var/www \
    && chmod -R 755 /var/www \
    && if [ -d "/var/www/storage" ]; then chmod -R 775 /var/www/storage; fi \
    && if [ -d "/var/www/bootstrap/cache" ]; then chmod -R 775 /var/www/bootstrap/cache; fi

USER appuser

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin \
    && chmod +x /usr/local/bin/composer

# Устанавливаем переменную окружения для кеша
ENV COMPOSER_CACHE_DIR=/tmp/composer-cache

# Устанавливаем переменную окружения для конфигурации
ENV COMPOSER_HOME=/tmp/composer-config

# Создаем директорию для конфига
RUN mkdir -p /tmp/composer-config

EXPOSE 9000

# Установка безопасных значений по умолчанию
ENV PHP_MEMORY_LIMIT=128M
ENV PHP_MAX_EXECUTION_TIME=30
ENV PHP_UPLOAD_MAX_FILESIZE=2M

CMD ["php-fpm", "-F"]
