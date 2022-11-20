# MLMSYS

A multilevel marketing system app built using laravel.

## Installation

Follow the instruction below sequentially,

- Clone the project

```sh
git clone https://github.com/saddamhshovon/mlmsys.git
```

- Open the directory

```sh
cd ./mlmsys
```

- Open terminal in the folder & run "composer install"

```sh
composer install
```

- After composer installs all packages, copy the ".env.example" file and set the database credentials

```sh
cp .env.example .env
```

- Migrate the database

```sh
php artisan migrate
```

- Generate an application key

```sh
php artisan key:gen
```

- Finaly run the project

```sh
php artisan serve
```
