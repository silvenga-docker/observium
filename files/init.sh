#!/bin/sh
set -e

if [ ${CRON} = "false" ]; then

    mkdir -p /opt/observium/rrd
    chown www-data:www-data /opt/observium/rrd
    mkdir -p /opt/observium/logs
    chown www-data:www-data /opt/observium/logs

    source /etc/apache2/envvars

    /opt/observium/discovery.php -u

    # Apache gets grumpy about PID files pre-existing
    rm -f ${APACHE_PID_FILE}

    exec apache2 -DFOREGROUND

else
    /bin/bash /loop.sh
fi

