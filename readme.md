## Description

This is an example user registration four steps application.

## Installation

You need **docker** and **docker compose** installed before proceed:

    $ curl -fsSL https://get.docker.com | sh
    # curl -L https://github.com/docker/compose/releases/download/1.22.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
    # chmod +x /usr/local/bin/docker-compose

More information on how to install both [here](https://docs.docker.com/engine/installation/) and [here](https://docs.docker.com/compose/install/).

    $ git clone https://gustavobgama@bitbucket.org/gustavobgama/user-registration.git ./UserRegistration
    $ cd UserRegistration && cp .env.example .env
    $ docker-compose up -d
    $ wait some moments and then check the application running here: http://127.0.0.1/

## Run tests

    $ docker-compose exec php ./vendor/bin/phpunit --testdox

## What can be made better ?

    * Validations relies on javascript, must be implemented backend validations using form request classes for example.
    * The frontend code can be improved (the form-step component)
    * Inject mocks at some tests to not touch the wunder API
    * Add frontend tests
    * Using the bitbucket pipeline to do a "live" deploy