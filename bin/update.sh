#!/bin/sh

git pull
composer install
bin/console d:s:u --force
bin/console cache:clear