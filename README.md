# nuker-duit monorepo

-----------------------------------------------------------------------

### Akun Demo :
email : admin@localhost.com
password : 123456  

-----------------------------------------------------------------------
# Setup Project Backend (PHP 7.4.30)

1. composer install

2. copy and rename .env.example to .env

3. php artisan key:generate

### Migrate Database

php artisan migrate

### Passport Install

php artisan passport:install

### Seed Database

php artisan db:seed

### Start Server
php artisan serve


### Create New User
you can create new user via : http://localhost:8000/register

--------------------------------------------------------------------------

# Setup Project Frontend (Node 18.16.1)


## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

### Lint with [ESLint](https://eslint.org/)

```sh
npm run lint
```

