#!/usr/bin/env sh

set -e

echo 'Creating symfony-dev-cli.phar'
bin/create-cli-phar.php
echo '################################'
echo
echo 'Building Docker container'
docker build -t 1994rstefan/symfony-dev:latest -t ghcr.io/1994rstefan/symfony-dev:latest ./docker/
docker push ghcr.io/1994rstefan/symfony-dev:latest
echo '################################'
