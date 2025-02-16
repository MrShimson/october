FROM php:8.3.12-fpm-alpine3.20

ARG DOCKER_UID_GID
ARG ENABLE_XDEBUG
ARG SETTINGS_CHECK_KEY
ARG APP_DIR

### Configure PHP

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY ./.docker/php/local/php-development.ini /usr/local/etc/php/conf.d/

### Install PHP extensions

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions \
    gd \
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

### Add app user

RUN adduser -S -s /bin/bash -u $DOCKER_UID_GID -D -h /home/appuser appuser

### Configure PHP-FPM

RUN sed -i -e 's/^user =.*/user = appuser/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i -e "s/^;pm.status_path =.*/pm\.status_path = \/php-fpm\/${SETTINGS_CHECK_KEY}/" /usr/local/etc/php-fpm.d/www.conf

USER $DOCKER_UID_GID:$DOCKER_UID_GID

### Run app
WORKDIR $APP_DIR
