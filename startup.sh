#!/bin/bash

cd /home/site/wwwroot

php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

sed -i 's#root /home/site/wwwroot;#root /home/site/wwwroot/public;#g' /etc/nginx/sites-available/default
sed -i 's#try_files \$uri \$uri/ =404;#try_files \$uri \$uri/ /index.php?\$args;#g' /etc/nginx/sites-available/default

service nginx reload
