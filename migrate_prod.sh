#!/bin/sh

docker-compose exec app-service bash -c "php artisan migrate"