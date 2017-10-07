FROM ubuntu:14.04

LABEL maintainer="Mark Lopez <m@silvenga.com>"

# libvirt-bin

RUN \
    set -xe \
    && DEBIAN_FRONTEND=noninteractive apt-get update -q \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php-apc \
    mysql-server \
    mysql-client \
    python-mysqldb \
    rrdtool \
    subversion \
    whois \
    mtr-tiny \
    ipmitool \
    graphviz \
    imagemagick \
    php5-cli \
    php5-mysql \
    php5-gd \
    php5-mcrypt \
    php5-json \
    php-pear \
    snmp \
    fping \
    php5 \
    apache2 \
    libapache2-mod-php5 \
    libvirt-bin \
    && rm -r /var/lib/apt/lists/* \
    && php5enmod mcrypt \
    && a2dismod mpm_event \
    && a2enmod mpm_prefork \
    && a2enmod php5 \
    && a2enmod rewrite
# RUN \
#     set -xe \
#     && DEBIAN_FRONTEND=noninteractive apt-get update -q \
#     && DEBIAN_FRONTEND=noninteractive apt-get install -y \
#     libapache2-mod-php7.0 \
#     php7.0-cli \
#     php7.0-mysql \
#     php7.0-mysqli \
#     php7.0-gd \
#     php7.0-mcrypt \
#     php7.0-json \
#     php-pear \
#     snmp \
#     fping \
#     mysql-common \
#     mysql-server \
#     mysql-client \
#     python-mysqldb \
#     rrdtool \
#     subversion \
#     whois \
#     mtr-tiny \
#     ipmitool \
#     graphviz \
#     imagemagick \
#     apache2 \
#     && rm -r /var/lib/apt/lists/* \
#     && phpenmod mcrypt \
#     && a2dismod mpm_event \
#     && a2enmod mpm_prefork \
#     && a2enmod php7.0 \
#     && a2enmod rewrite

COPY vendor /opt/observium
COPY files/observium.conf /etc/apache2/sites-available/observium.conf

COPY files/config.override.php /opt/observium/config.php
COPY files/config.custom.php /opt/observium/config.custom.php
COPY files/config.env.php /opt/observium/config.env.php

RUN set -xe \
    && a2ensite observium.conf \
    && a2dissite 000-default.conf

COPY files/init.sh /init.sh
COPY files/loop.sh /loop.sh

EXPOSE 80
VOLUME [ "/opt/observium/rrd", "/opt/observium/logs" ]
CMD ["/bin/bash", "/init.sh"]

ENV CRON "false"