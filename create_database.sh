#!/bin/sh

user='bart'
prod_database='english_essence'
test_database='english_essence_test'

docker-compose exec db-service psql -U postgres -c "CREATE USER $user"
docker-compose exec db-service psql -U postgres -c "CREATE DATABASE $prod_database"
docker-compose exec db-service psql -U postgres -c "CREATE DATABASE $test_database"
docker-compose exec db-service psql -U postgres -c "GRANT ALL PRIVILEGES ON DATABASE $prod_database TO $user"
docker-compose exec db-service psql -U postgres -c "GRANT ALL PRIVILEGES ON DATABASE $test_database TO $user"
