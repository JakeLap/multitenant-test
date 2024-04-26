# Laravel multitenancy test

This project uses PHP 8.3, Laravel 11 and Livewire. To handle the multitenancy spatie's laravel-multitenancy has been user.

## Set up

This project uses Laravel Sail (Laravel's first party docker wrapper). You must have docker installed locally.

### Environment

- Firstly rename .env.example to .env
- In your /etc/hosts create the following entries

```
127.0.0.1   tenant1.test
127.0.0.1   tenant2.test
```

### Laravel Sail set up

To initialize sail and create the necessary containers run the following command.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### Start containers

```
./vendor/bin/sail up -d
```

Hint: If you wish you can create a bashrc alias to shorten the sail command like so:

```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

### Install dependencies

```
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

### Landlord

Docker will automatically create a landlord database. To migrate and seed run the following command:

```
./vendor/bin/sail artisan migrate:fresh --seed --path=database/migrations/landlord --database=landlord
```

### Tenants

I have also configured Docker to create 2 tenant databases (tenant1, tenant2). You can migrate and seed them like so:

```
./vendor/bin/sail artisan tenant:artisan "migrate:fresh --seed"
```

## Usage 

You should now be able to visit tenant1.test:8080 or tenant2.test:8080 to visit the site.

You can log in using the user: **admin@test.tes**.

For simplicity **all users have been seeded with the password "123456789"** in case you want to use any other user.


## Tests

Some example tests have been created using Pest. You can run them like so:

```
./vendor/bin/sail test --env=testing
```
