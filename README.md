# Local install

## Requirements

 * Docker (v2.10+)
 * npm

## Run locally

In a terminal: 

 * `docker compose up` (This can take a while when building for the first time! 1300s on my last attempt)
 * `docker compose exec php sh`
 * `chmod 777 -R public/uploads/dishes` (This is a fix to allow uploading of images through the website. It is probably not optimal)

In a second terminal: 

 * `npm install`
 * `npm run watch` (The node container seems to not compile the files)

Open `https://localhost` (you might have to accept an unsigned certificate)

## Create the user admin

You can generate the fixtures on the dev database and use the account `test@mail.com:root`

You can also make your own admin account through the database:
 * `docker compose exec php sh`
 * `php bin/console security:hash-password`
 * Follow the prompt and copy the password hash
 * `exit`
 * `docker compose exec database psql -U app`
 * Run the following command, replacing `EMAIL` with your email and `PASSWORD` with the copied hash
 * `INSERT INTO "user" (id, email, roles, password) VALUES (nextval('user_id_seq'), 'EMAIL', '["ROLE_ADMIN"]', 'PASSWORD');`

## Generate some blank data (opening hours, maximum number of guests

 * `docker compose exec php sh`
 * `php bin/console app:generate-entities`

## Generate some fixture data on the dev database

 * `docker compose exec php sh`
 * `php bin/console doctrine:fixtures:load`
 * Accept the prompt

## Testing

### Create the test database with fixture data

 * `docker compose exec php sh`
 * `php bin/console doctrine:database:create --env=test`
 * `php bin/console doctrine:schema:create --env=test`
 * `php bin/console doctrine:fixtures:load --env=test`
 * Accept the prompt

### Running tests

You must start the containers with `docker compose up `

 * `docker compose exec php sh`
 * `php bin/phpunit` (available test suites to use with the `--testsuite` option: `unit`, `integration`, `functional`
