#!/usr/bin/env sh

set -e

echo 'Creating symfony-dev-cli.phar'
bin/create-cli-phar.php
echo '################################'
echo
echo 'Building Docker container'
docker build -t ghcr.io/wiet-at/symfony-dev/cli:latest ./docker/
docker push ghcr.io/wiet-at/symfony-dev/cli:latest
echo '################################'
