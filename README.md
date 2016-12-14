# slim3-skeleton
Slim 3 skeleton

## Install

composer create-project --stability=dev lalocespedes/slim3-skeleton [my-app-name]

composer install

Set .env file
Set phinx.yml

## Migration

vendor/bin/phinx create MyFirstMigration

# RUN server

php -S 0.0.0.0:8080 -t public

or composer run-script start

