
# Symfony DEV CLI
Docker based DEV environment for symfony projects.
Similar to what Laravel Sail is to Laravel.

## Requirements
* `docker` and `docker-compose` running locally.

# Installation
### Create new Symfony project
Use the `create-project.sh` helper script to create a new symfony project.
It will use the `symfony` command to create a new project and install the required dependencies.

    curl -s 'https://raw.githubusercontent.com/wiet-at/symfony-dev/main/bin/create-project.sh' | bash -s -- [options] [--] <directory> [<symfony-cli-args>...]

###### Arguments:

    directory                            Directory of the project to create
    symfony-cli-args                     Pass additional arguments/options to Symfony CLI (requires -- to be used)

###### Options:

    --project-version[=PROJECT-VERSION]  The version of the Symfony skeleton (a version or one of "lts", "stable", "next", or "previous") [default: "stable"]
    --full                               Use github.com/symfony/website-skeleton

#### Example

    curl -s 'https://raw.githubusercontent.com/wiet-at/symfony-dev/main/bin/create-project.sh' | bash -s -- --full my-project

### Add to existing project
Use composer to install `wiet-at/symfony-dev` as dev dependency.

# Configuration
Symfony Flex should have copied all required files. Check your `.env` and adjust it accordingly to your needs.  
**IMPORTANT:** If you change the `COMPOSE_PROJECT_NAME` afterwards, new docker containers will get created and you will lose your database for example.

The `SD_LOCAL_IP` will be the IP address to which the containers will bind their port forwards. You can use any IP addresses inside 127.0.0.0/8.  
When, for example, using `127.1.2.3` you can access the application under `http://123.1.2.3`.

# Usage
Symfony Flex should have installed `bin/dev-cli`.
This is a proxy script which forwards specific commands (see "Known commands") to the correct docker container.
All other commands will get passed directly to `docker-compose.`

### Start development environment
To start all services just run the following command:

    bin/dev-cli up -d

This basically runs `docker-compose up -d`.
You don't need to use the `-d` flag and also can pass other flags which you normally would pass to `docker-compose`.

### Known commands
For easy of use there are some commands which will get executed inside the correct docker container automatically.

* php
* symfony
* composer
* node
* npm
* yarn

You can use those commands the same way you would normally do, just prefix them with `bin/dev-cli`.  
To install the `symfony/monolog-bundle` using `composer` you have to run following command:

    bin/dev-cli composer require symfony/monolog-bundle

