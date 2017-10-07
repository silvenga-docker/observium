#!/bin/bash

INIT_SECONDS=0

case "${CRON}" in
    "complete-discovery")
          SLEEP_SECONDS=21600
          COMMAND="/opt/observium/discovery.php -h all"
          ;;
    "automated-discovery")
          SLEEP_SECONDS=300
          COMMAND="/opt/observium/discovery.php -h new"
          ;;
    "poller")
          SLEEP_SECONDS=300
          COMMAND="/opt/observium/poller-wrapper.py 4"
          ;;
    "housekeeping")
          SLEEP_SECONDS=86400
          COMMAND="/opt/observium/housekeeping.php -ya"
          ;;
esac

echo "Set to run commamd ${COMMAND}."
echo "Waiting ${INIT_SECONDS} seconds to begin loop."
sleep ${INIT_SECONDS}

echo "Loop will sleep for ${SLEEP_SECONDS} seconds."
echo "Loop will now begin."

trap "break;exit" SIGHUP SIGINT SIGTERM
while /bin/true; do
    ${COMMAND}
    sleep ${SLEEP_SECONDS}
done