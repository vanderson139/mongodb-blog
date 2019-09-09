#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#
# To edit the 'php-fpm' base Image, visit its repository on Github
#    https://github.com/Laradock/php-fpm
#
# To change its version, see the available Tags on the Docker Hub:
#    https://hub.docker.com/r/laradock/php-fpm/tags/
#
# Note: Base Image name format {image-tag}-{php-version}
#

FROM laradock/php-fpm:2.5-7.3

# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# always run apt update when start and after add new source list, then clean up at end.
RUN set -xe; \
    apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq \
      apt-utils \
      #
      #--------------------------------------------------------------------------
      # Mandatory Software's Installation
      #--------------------------------------------------------------------------
      #
      # Mandatory Software's such as ("mcrypt", "pdo_mysql", "libssl-dev", ....)
      # are installed on the base image 'laradock/php-fpm' image. If you want
      # to add more Software's or remove existing one, you need to edit the
      # base image (https://github.com/Laradock/php-fpm).
      #
      # next lines are here becase there is no auto build on dockerhub see https://github.com/laradock/laradock/pull/1903#issuecomment-463142846
      libzip-dev zip unzip && \
      docker-php-ext-configure zip --with-libzip && \
      # Install the zip extension
      docker-php-ext-install zip && \
      php -m | grep -q 'zip'

###########################################################################
# xDebug:
###########################################################################

# Install the xdebug extension
RUN if [ $(php -r "echo PHP_MAJOR_VERSION;") = "5" ]; then \
pecl install xdebug-2.5.5; \
else \
pecl install xdebug; \
fi && \
docker-php-ext-enable xdebug

# Copy xdebug configuration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN sed -i "s/xdebug.remote_autostart=0/xdebug.remote_autostart=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.remote_enable=0/xdebug.remote_enable=1/" /usr/local/etc/php/conf.d/xdebug.ini && \
    sed -i "s/xdebug.cli_color=0/xdebug.cli_color=1/" /usr/local/etc/php/conf.d/xdebug.ini

###########################################################################
# MongoDB:
###########################################################################

# Install the mongodb extension
RUN if [ $(php -r "echo PHP_MAJOR_VERSION;") = "5" ]; then \
  pecl install mongo && \
  docker-php-ext-enable mongo \
;fi && \
pecl install mongodb && \
docker-php-ext-enable mongodb

###########################################################################
# bcmath:
###########################################################################

# Install the bcmath extension
RUN docker-php-ext-install bcmath

###########################################################################
# Human Language and Character Encoding Support:
###########################################################################

# Install intl and requirements
RUN apt-get install -y zlib1g-dev libicu-dev g++ && \
docker-php-ext-configure intl && \
docker-php-ext-install intl

###########################################################################
# Image optimizers:
###########################################################################

USER root

RUN apt-get install -y jpegoptim optipng pngquant gifsicle

###########################################################################
# ImageMagick:
###########################################################################

USER root

RUN apt-get install -y libmagickwand-dev imagemagick && \
pecl install imagick && \
docker-php-ext-enable imagick

###########################################################################
# Check PHP version:
###########################################################################

RUN set -xe; php -v | head -n 1 | grep -q "PHP 7.3."

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

COPY ./laravel.ini /usr/local/etc/php/conf.d
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
