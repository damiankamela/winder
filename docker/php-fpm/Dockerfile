FROM phpdockerio/php72-fpm

RUN apt-get update \
    && apt-get -y --no-install-recommends install git ssh libreoffice wget nginx iputils-ping \
    php7.2-mysql \
    php7.2-redis \
    php7.2-bcmath \
    php7.2-bz2 \
    php7.2-gd \
    php7.2-igbinary \
    php7.2-imap \
    php7.2-imagick \
    php7.2-intl \
    php7.2-ldap \
    php7.2-mbstring \
    php7.2-soap \
    php7.2-ssh2 \
    php7.2-xmlrpc \
    php7.2-xsl \
    php7.2-xdebug

COPY docker/php-fpm/entrypoint.sh /entrypoint.sh
RUN chmod 755 /entrypoint.sh
RUN touch /var/log/phpd.log
RUN chmod 777 /var/log/phpd.log

RUN useradd winder
RUN usermod -s /bin/bash -u 1000 winder
USER winder

ENTRYPOINT ["/entrypoint.sh"]
