#!/bin/sh
# This script checks if the container is started for the first time.
set -e


CONTAINER_FIRST_STARTUP="CONTAINER_FIRST_STARTUP"

php -r 'echo "DB_PASSWORD in PHP: " . getenv("DB_PASSWORD") . "\n";'
if [ ! -e /$CONTAINER_FIRST_STARTUP ]; then
    echo  "Initial Run Appication Laravel"
    touch /$CONTAINER_FIRST_STARTUP
    # place your script that you only want to run on first startup.
    #php artisan migrate
    #php artisan db:seed
    if [[ ! -d "/var/www/html/storage/app/public" ]]; then  
        mkdir -p /var/www/html/storage/app/public
        chown -R www-data:www-data /var/www/html/storage/app/public
        chmod -R 755 /var/www/html/storage/app
    fi

    php artisan storage:link
    echo  "Initial Run optimize"
    php artisan optimize
    echo  "Initial Run migrate"
    php artisan migrate  --force
    echo  "Initial Run db:seed"
    php artisan db:seed --force
    # php artisan passport:install --force
    php artisan key:generate
    echo  "Initial Run route clear"
    php artisan route:clear
    echo  "Initial Run config clear"
    php artisan config:clear
    echo  "Initial Run cache clear"
    php artisan cache:clear
    echo  "Initial Run route cache"
    php artisan route:cache
    echo  "Initial Run config cache"
    php artisan config:cache
    echo  "Initial Run view clear"
    php artisan view:clear
    echo  "Initial Run view cache"
    php artisan view:cache
    chown -R www-data:www-data /var/www/html/storage
    
    # script that should run the rest of the times (instances where you 
    # stop/restart containers).
fi

# nginx -g "daemon off;"
# php artisan serve --host=0.0.0.0 --port=5000

exec /usr/bin/supervisord -c /etc/supervisord.conf