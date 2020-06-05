FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    supervisor \
    netcat \
    git \
    nano \
#   php7.4-mysql \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    nginx

RUN docker-php-ext-install pdo_mysql gd zip
RUN docker-php-ext-install pdo_mysql

# add user for php-fpm / nginx processes
RUN useradd -d /home/medial -s /bin/bash medial && \
    mkdir /home/medial && \
    mkdir /home/medial/.ssh && \
    mkdir /home/medial/application && \
    chown -R medial:medial /run && \
    chown -R medial:medial /home/medial && \
    chown -R medial:medial /var/log/nginx/ && \
    chown -R medial:medial /var/lib/nginx/

# get composer to resolve dependencies
RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

COPY --chown=medial:medial ./nginx.conf /etc/nginx/nginx.conf
COPY --chown=medial:medial ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#COPY --chown=pbm:pbm ./php.ini /usr/local/etc/php/php.ini

# run commands as pbm user
USER medial

WORKDIR /home/medial/application

EXPOSE 8080

COPY --chown=medial:medial ./ /home/medial/application

RUN composer install

# entry point
# evtl. npm install


CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
