#!/bin/sh
set -e

# Ensure storage directories exist and have correct permissions
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

# Wait for DB to be ready if environment variables are provided
if [ -n "$DB_HOST" ]; then
    echo "Checking database connection on $DB_HOST:$DB_PORT..."
    # A simple loop to wait for database connection (max 30 seconds)
    i=0
    until [ $i -ge 30 ]
    do
        nc -z -w 1 "$DB_HOST" "${DB_PORT:-5432}" && break
        i=$((i+1))
        echo "Waiting for database to accept connections... ($i/30)"
        sleep 1
    done
fi

# Run migrations (force for production environments)
echo "Running migrations..."
php artisan migrate --force

# Optimize Laravel application (caching config, routes)
echo "Caching configurations..."
php artisan config:cache
php artisan route:cache

# Start supervisor (runs nginx & php-fpm)
echo "Starting Supervisord..."
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
