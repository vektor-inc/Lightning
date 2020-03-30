FROM wordpress:cli-php7.3
USER root
WORKDIR /var/www/lightning

RUN apk add --no-cache subversion
RUN cd /opt/ && curl -sS https://getcomposer.org/installer | php
RUN cd /opt && php /opt/composer.phar require --dev "phpunit/phpunit=7.5.9"
ADD bin /var/www/lightning/bin
RUN bash /var/www/lightning/bin/install-wp-tests.sh wordpress wordpress wordpress db latest true

CMD "vendor/bin/phpunit"
