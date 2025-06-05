FROM composer:latest as composer
FROM php:8.4-fpm-alpine3.21

ARG TZ
ARG UID
ARG GID

# Установка timezone
RUN set -eux \
    && apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo "${TZ}" > /etc/timezone \
    && apk del tzdata

# Установка пакетов
RUN set -eux \
    && apk add --no-cache \
        shadow \
        openssh \
        openssl \
        bash \
        zsh \
        zsh-vcs \
        linux-headers \
        freetype \
        icu \
        icu-libs \
        libzip \
        libpng \
        libjpeg-turbo \
        imagemagick \
        build-base \
        procps \
        make \
        nano \
        vim \
        git \
        wget \
        libwebp \
        libwebp-tools \
        lz4 \
        mysql-client

# Установка php пакетов
RUN set -eux \
    && apk add --no-cache --virtual .build-deps-php \
        $PHPIZE_DEPS \
        openssl-dev \
        zlib-dev \
        imagemagick-dev \
        icu-dev \
        g++ \
        automake \
        autoconf \
        libzip-dev \
        libpng-dev \
        libwebp-dev \
        libjpeg-turbo-dev \
        freetype-dev \
    && pecl install \
        redis \
        xdebug \
    && docker-php-ext-configure \
        gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo \
        pdo_mysql \
        intl \
        pcntl \
        opcache \
        exif \
        zip \
    && docker-php-ext-enable \
        redis \
        xdebug \
    && apk del -f .build-deps-php \
    && rm -rf /usr/src/php* \
    && rm -rf /tmp/pear

# Установка конфигурации
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Установка composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Настройка пользователя
RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data
USER www-data

# Настройка zsh для удобства
RUN sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
RUN git clone https://github.com/zsh-users/zsh-syntax-highlighting /home/www-data/.oh-my-zsh/custom/plugins/zsh-syntax-highlighting
RUN git clone https://github.com/zsh-users/zsh-autosuggestions /home/www-data/.oh-my-zsh/custom/plugins/zsh-autosuggestions

# Порты
EXPOSE 9000

# Старт php-fpm
CMD ["php-fpm"]