#!/usr/bin/env bash

set -e

# Test if Docker Compose is installed
if [ -f /.dockerenv ] && [ -z $(which docker-compose) ]; then
    echo "docker-compose is required."
    exit 1
fi

# Display command lines
set -x

docker-compose stop

docker-compose ps
