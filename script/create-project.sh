#!/usr/bin/env sh
# shellcheck disable=SC2068
docker run --rm -v "$(pwd)":/app --env SYMFONY_DEV_USER="$(id -u)" --env SYMFONY_DEV_GROUP="$(id -g)" 1994rstefan/symfony-dev symfony new $@
