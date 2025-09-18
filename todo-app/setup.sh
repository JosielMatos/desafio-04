#!/bin/bash

# Container name
CONTAINER_NAME=todo-app

# Install Composer dependencies
docker exec todo-app composer install --ignore-platform-req=php

docker exec $CONTAINER_NAME mkdir migrations

# Create migration file
docker exec $CONTAINER_NAME php bin/console make:migration --no-interaction

# Run migrations
docker exec $CONTAINER_NAME php bin/console doctrine:migrations:migrate --no-interaction
