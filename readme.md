
## REQUIREMENT
docker  
docker-compose
git

## INSTALLATION

```bash
git clone https://github.com/sr-hosseyni/simple-orders-management
cd simple-orders-management
cp .env.example .env
cp www/.env.example www/.env
docker-compose up -d
docker-compose run --rm php-fpm composer install
docker-compose run --rm nodejs npm install
docker-compose run --rm php-fpm php artisan migrate:install  
docker-compose run --rm php-fpm php artisan migrate --seed
docker-compose run --rm nodejs npm run development
open http://localhost:8080
```
or if you have already cloned just run 
```bash
#chmod +x install.sh
./install.sh
```
