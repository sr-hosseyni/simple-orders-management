
## INSTALLATION

```
docker-compose up -d
docker-compose run --rm php-fpm composer install
docker-compose run --rm nodejs npm install
docker-compose run --rm php-fpm php artisan migrate:install  
docker-compose run --rm php-fpm php artisan migrate --seed
docker-compose run --rm nodejs npm run development
```
