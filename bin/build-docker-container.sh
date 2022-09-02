#!/usr/bin/env sh

set -e

echo 'Creating symfony-dev-cli.phar'
bin/create-cli-phar.php
echo '################################'
echo
echo 'Building Docker container'
docker build -t ghcr.io/wiet-at/symfony-dev/cli:latest -t ghcr.io/wiet-at/symfony-dev/cli:php-8.1 ./docker/
docker push --all-tags ghcr.io/wiet-at/symfony-dev/cli
echo '################################'
