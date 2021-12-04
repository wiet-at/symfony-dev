#!/usr/bin/env sh

if [ -n "$SYMFONY_DEV_USER" ] && [ "$SYMFONY_DEV_USER" != "$(id -u symfony-dev)" ]; then
  usermod -u "$SYMFONY_DEV_USER" symfony-dev
fi
if [ -n "$SYMFONY_DEV_GROUP" ] && [ "$SYMFONY_DEV_GROUP" != "$(id -g symfony-dev)" ]; then
  groupmod -g "$SYMFONY_DEV_GROUP" symfony-dev
fi

if [ $# -gt 0 ]; then
  exec gosu "$SYMFONY_DEV_USER" "$@"
fi
