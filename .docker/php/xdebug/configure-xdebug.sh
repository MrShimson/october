#!/usr/bin/env sh

MAC_HOST_DOMAIN="host.docker.internal"
if ! ping -q -c1 $MAC_HOST_DOMAIN > /dev/null 2>&1
then
  LINUX_HOST_IP=`/sbin/ip route|awk '/default/ { print $3 }'`
  sed -i -e "s/xdebug\.client_host\=.*/xdebug\.client_host\=$LINUX_HOST_IP/g" /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi

if [ "$ENABLE_XDEBUG" -eq "0" ];
then
  rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi
