FROM alpine:3.7

WORKDIR /var/www
EXPOSE 80
ENV APP_MODE=backend
VOLUME /var/www/storage
ENTRYPOINT [ "/run.sh" ]
CMD ["www"]
ENV TZ Europe/Moscow

################################################################################

RUN mkdir -p /var/www
ARG T1=89c5748acf53e86ffe535be
ARG T2=38919fca77756b4a9

# Install dependencies
RUN apk add --no-cache \
    php7 php7-fpm php7-json php7-gd php7-curl \
    php7-mbstring php7-ctype php7-tokenizer php7-xmlwriter php7-session \
    php7-zlib php7-bz2 php7-zip \
    php7-phar php7-openssl \
    php7-xml php7-dom \
    php7-pdo php7-pdo_mysql php7-pdo_sqlite sqlite sqlite-dev \
    php7-intl php7-mcrypt php7-pcntl php7-bcmath php7-iconv php7-gd php7-imagick \
    nginx supervisor curl tzdata gettext
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && composer global require fxp/composer-asset-plugin \
    && composer config --global --auth github-oauth.github.com $T1$T2

# composer install vendor
# add cash to composer
ADD composer.json /tmp/composer.json
RUN cd /tmp && composer install  --prefer-dist --optimize-autoloader
RUN mkdir -p /var/www && cp -a /tmp/vendor /var/www
# close cash composer
ADD . /var/www

# Copy configuration
COPY ./docker/php/etc /etc/

# Copy main script
COPY ./docker/run.sh /run.sh
RUN chmod u+rwx /run.sh

# Copy project
ADD . /var/www

RUN php init --env=Production --overwrite=y

# Set permision
RUN set -x \
    && chown -R root:nobody /var/www \
    && find /var/www -type d -exec chmod 750 {} \; \
    && find /var/www -type f -exec chmod 640 {} \; \
    && chmod 777 -R /var/www/frontend/runtime \
    && chmod 777 -R /var/www/frontend/web/assets \
    && chmod 777 -R /var/www/backend/runtime \
    && chmod 777 -R /var/www/backend/web/assets