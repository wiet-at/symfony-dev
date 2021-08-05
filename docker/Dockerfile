FROM debian:buster

ENV SYMFONY_DEV_USER=1000
ENV SYMFONY_DEV_GROUP=1000

RUN apt-get update \
    # System base
    && apt-get install -y ca-certificates git gnupg gosu wget \
    # PHP
    && echo 'deb https://packages.sury.org/php/ buster main' > /etc/apt/sources.list.d/sury-php.list \
    && apt-key adv --fetch-keys 'https://packages.sury.org/php/apt.gpg' \
    && apt-get update \
    && apt-get install -y php8.0-cli php8.0-gd php8.0-curl php8.0-mysql \
    php8.0-mbstring php8.0-xml php8.0-zip php8.0-intl php8.0-xdebug \
    # Composer
    && php -r 'readfile("http://getcomposer.org/installer");' | php -- --install-dir=/usr/bin/ --filename=composer \
    # Symfony CLI
    && php -r 'readfile("https://get.symfony.com/cli/installer");' | bash -s -- --install-dir=/usr/local/bin/ \
    # Node.js (and NPM)
    && php -r 'readfile("https://deb.nodesource.com/setup_16.x");' | bash \
    && apt-get install -y nodejs \
    # Yarn
    && echo 'deb https://dl.yarnpkg.com/debian/ stable main' > /etc/apt/sources.list.d/yarn.list \
    && apt-key adv --fetch-keys 'https://dl.yarnpkg.com/debian/pubkey.gpg' \
    && apt-get update \
    && apt-get install -y yarn

RUN groupadd -g $SYMFONY_DEV_GROUP symfony-dev \
    && useradd -ms /bin/bash --no-user-group -g $SYMFONY_DEV_GROUP -u $SYMFONY_DEV_USER symfony-dev \
    && gosu $SYMFONY_DEV_USER git config --global user.name "Symfony DEV" \
    && gosu $SYMFONY_DEV_USER git config --global user.email "cli@symfony-dev.local"

WORKDIR /app
COPY entrypoint.sh /usr/local/bin/docker-entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint"]
