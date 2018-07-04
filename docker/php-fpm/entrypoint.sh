#!/bin/sh

set -e

#cat /run/secrets/ssh_private_key > /root/.ssh/id_rsa
#cat /run/secrets/ssh_public_key > /root/.ssh/id_rsa.pub
#chmod 600 /root/.ssh/id_rsa
#chmod 600 /root/.ssh/id_rsa.pub

cd /application && nohup ./bin/console server:run 0.0.0.0:8000 > /var/log/phpd.log 2>&1 &

sleep infinity
