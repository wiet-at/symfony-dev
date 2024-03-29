FROM debian:buster

ENV SYMFONY_DEV_USER=1000
ENV SYMFONY_DEV_GROUP=1000

RUN apt-get update \
    # System base
    && apt-get install -y ca-certificates git gnupg gosu unzip wget \
    # PHP
    && echo 'deb https://packages.sury.org/php/ buster main' > /etc/apt/sources.list.d/sury-php.list \
    && apt-key adv --fetch-keys 'https://packages.sury.org/php/apt.gpg' \
    && apt-get update \
    && apt-get install -y php8.1-cli php8.1-gd php8.1-curl php8.1-mysql php8.1-pgsql \
    php8.1-mbstring php8.1-xml php8.1-zip php8.1-intl php8.1-xdebug \
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
    && apt-get install -y yarn \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupadd -g $SYMFONY_DEV_GROUP symfony-dev \
    && useradd -ms /bin/bash --no-user-group -g $SYMFONY_DEV_GROUP -u $SYMFONY_DEV_USER symfony-dev \
    && gosu $SYMFONY_DEV_USER git config --global user.name "Symfony DEV" \
    && gosu $SYMFONY_DEV_USER git config --global user.email "cli@symfony-dev.local"

EXPOSE 8000

WORKDIR /app
COPY entrypoint.sh /usr/local/bin/docker-entrypoint
COPY symfony-dev-cli.phar /usr/local/bin/symfony-dev-cli
ENTRYPOINT ["/usr/local/bin/docker-entrypoint"]
