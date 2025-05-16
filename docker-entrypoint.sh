#!/bin/sh
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Starting supervisord..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
