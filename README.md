# slim3-skeleton
Slim 3 skeleton

## Install

composer create-project --stability=dev lalocespedes/slim3-skeleton [my-app-name]

composer install

Set .env file
For develolment
DB_CONNECTION=sqlite
DB_HOST=
DB_DATABASE=../storage/data/derby
DB_USERNAME=
DB_PASSWORD=

Set phinx.yml

bower install

npm install

## Migration

vendor/bin/phinx create MyFirstMigration

# RUN server

php -S 0.0.0.0:8080 -t public

or gulp
