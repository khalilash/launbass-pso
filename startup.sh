#!/bin/bash
cd /home/site/wwwroot
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
chmod -R 775 /home/site/wwwroot/storage
chmod -R 775 /home/site/wwwroot/bootstrap/cache
cat > /etc/nginx/sites-available/default <<'EOF'
server {
    listen 8080;
    listen [::]:8080;
    root /home/site/wwwroot/public;
    index index.php index.html index.htm;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~* [^/]\.php(/|$) {
        fastcgi_split_path_info ^(.+?\.[Pp][Hh][Pp])(|/.*)$;
        fastcgi_pass 127.0.0.1:9000;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
EOF
service nginx restart
php-fpm
