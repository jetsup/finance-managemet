# Instructions and commands executed

## Install Dependencies `(STEP 1)`

After cloning the project, run the following command to install dependencies specified in `composer.json`

```bash
composer update
```
or
```bash
composer install
```

## Create a hashkey for the system `(STEP 2)`

To create a unique key, run the following command and it will populate the `APP_KEY` field in the _`.env`_ file:
```bash
php artisan key:generate
```

## Database `(STEP 3)`

Before running migrations make sure to create the database, in the `MYSQL` server.

Run the following command in the `cmd` to open the `mariadb` or `mysql` shell:

```bash
mariadb -u {USERNAME} -p # replace {USERNAME} with the database username eg *root*
# It will prompt for the password *toor*
```

Then create the actual database:

```bash
CREATE DATABASE {DATABASENAME} # {DATABASENAME} should be specified in the `DB_DATABASE` field ini the `.env` file
```
### For development

The tables must be created considering the following order:

```bash
php artisan make:migration create_account_type_table
```

Rename the table so that it be on the top of the migrations list.

### Run migrations `(STEP 4)`

After creating the tables, run the migrations so that the tables are created in the database:

```bash
php artisan migrate
```

Alternatively, you can run the following command to create the tables and run the migrations and seeders:

```bash
php artisan migrate:refresh --seed
```

## Models

To create a model, for example the model `AccountType`, run the following command:

```bash
php artisan make:model AccountType
```

## Utility Commands `(STEP 5)`

If you change anything in the composer.json file, run the following command to update the dependencies:

```bash
composer update
```

If you change the autoload classmap, run the following command to update the autoload:

```bash
composer dump-autoload
```

`IMPORTANT:` Create a symlink to the storage folder:

```bash
php artisan storage:link
```

## Run the server `(STEP 6)`

To run the server run the following command:

```bash
php artisan serve
```
*If the port `8080` is currently in use, run the following command to specify the port to use:*

```bash
php artisan serve --port 9090 # just make sure that you use any port number greter than 5000 to avoid collision with OS's ports
```

## Libraries used

For generating PDFs, the library [dompdf](https://github.com/barryvdh/laravel-dompdf) is used. To install it, run the following command:

```bash
composer require barryvdh/laravel-dompdf
```

Publish the assets from vendor:

```bash
php artisan vendor:publish
```
