FROM php:8.3.13-alpine3.20

ARG DOCKER_UID_GID
ARG ENABLE_XDEBUG
ARG APP_DIR

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
    rm /docker-entrypoint.d/40-configure-xdebug.sh && \
    echo ENABLE_XDEBUG = $ENABLE_XDEBUG \
    ; else \
    rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug-disabled.ini && \
    echo ENABLE_XDEBUG = $ENABLE_XDEBUG \
    ; fi

### Add user
RUN adduser -S -s /bin/bash -u $DOCKER_UID_GID -D -h /home/appuser appuser
USER $DOCKER_UID_GID:$DOCKER_UID_GID

### Run app
WORKDIR $APP_DIR
