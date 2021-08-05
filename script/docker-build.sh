#!/usr/bin/env sh

docker build -t ghcr.io/1994rstefan/symfony-dev:latest ./docker/
docker push ghcr.io/1994rstefan/symfony-dev:latest
