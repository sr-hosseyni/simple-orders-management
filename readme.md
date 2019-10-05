docker-compose up -d
docker-compose run --rm php-fpm php artisan migrate:install  
