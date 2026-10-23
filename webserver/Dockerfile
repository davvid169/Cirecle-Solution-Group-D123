FROM php:8.2-apache-bullseye

COPY custom.php.ini /usr/local/etc/php/conf.d/custom-settings-php.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY *.conf /etc/apache2/sites-available
COPY --chown=root:root *.conf /etc/apache2/sites-available

RUN mkdir /var/www/project
RUN    pecl  install xdebug
RUN  docker-php-ext-enable xdebug

# Enable modules
RUN a2enmod rewrite headers && \
    a2dissite 000-default && \
    a2ensite project.conf && \
    chown -R www-data:users /var/www/project && \
    chmod -R g+rwX /var/www/project && \
    chmod -R o+rwX /var/www/project
