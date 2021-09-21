#!/usr/bin/env sh
# shellcheck disable=SC2068
docker run -i --rm -v "$(pwd)":/app --env SYMFONY_DEV_USER="$(id -u)" --env SYMFONY_DEV_GROUP="$(id -g)" ghcr.io/wiet-at/symfony-dev/cli symfony-dev-cli create-project $@
