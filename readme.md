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
    $ read carefully the file config/moviedownloader.php and custom accordingly the .env file
    $ docker-compose up
