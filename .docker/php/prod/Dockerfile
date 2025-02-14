FROM php:8.3.12-fpm-alpine3.20

ARG ENABLE_XDEBUG
ARG SETTINGS_CHECK_KEY
ARG APP_DIR

### Configure PHP

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY ./.docker/php/local/php-production.ini /usr/local/etc/php/conf.d/

### Install PHP extensions

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    opcache \
    pdo_mysql \
    redis \
    xdebug

### Install Composer

RUN curl -sS https://getcomposer.org/installer | php -- \
    --version=2.8.1 \
    --install-dir=/usr/local/bin \
    --filename=composer

### Configure Xdebug

COPY ./.docker/php/xdebug/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./.docker/php/xdebug/docker-php-ext-xdebug-disabled.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug-disabled.ini
COPY ./.docker/php/xdebug/configure-xdebug.sh /docker-entrypoint.d/
RUN if [[ ${ENABLE_XDEBUG} = "0" ]] ; then \
    rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    rm /docker-entrypoint.d/configure-xdebug.sh && \
    echo ENABLE_XDEBUG = $ENABLE_XDEBUG \
    ; else \
    rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug-disabled.ini && \
    echo ENABLE_XDEBUG = $ENABLE_XDEBUG \
    ; fi

### Configure PHP-FPM

RUN sed -i -e 's/^user =.*/user = root/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i -e "s/^;pm.status_path =.*/pm\.status_path = \/php-fpm\/${SETTINGS_CHECK_KEY}/" /usr/local/etc/php-fpm.d/www.conf && \
echo "pm = dynamic" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "pm.max_children = 20" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "pm.start_servers = 5" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "pm.min_spare_servers = 5" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "pm.max_spare_servers = 10" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "max_execution_time = 30" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "request_terminate_timeout = 300" >> /usr/local/etc/php-fpm.d/www.conf && \
echo "memory_limit = 128M" >> /usr/local/etc/php-fpm.d/www.conf

### Run app

WORKDIR $APP_DIR
