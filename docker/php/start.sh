#!/usr/bin/env sh

_="$(dirname "$0")/../_functions"

$_/user_setup www-data
$_/composer
$_/artisan-keygen
$_/artisan-migrate

echo "===> Initializing php-fpm"
php-fpm
