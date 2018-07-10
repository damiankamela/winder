#!/bin/sh

echo "Updating source"
git pull

echo "Composer install"
composer install

echo "Update database schema"
bin/console d:s:u --force

echo "Cache clear"
bin/console cache:clear

echo "Application is up to date."