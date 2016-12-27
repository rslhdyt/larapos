[![Build Status](https://travis-ci.org/rslhdyt/larapos.svg?branch=master)](https://travis-ci.org/rslhdyt/larapos) 
[![StyleCI](https://styleci.io/repos/66663471/shield?branch=master)](https://styleci.io/repos/66663471)

# LaraPOS

Simple Point of Sale Aplications build with laravel 5.3 and VueJs

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisities

- PHP >= 5.6
- MySQL or Postgres
- Nodejs

### Installing

1. Clone this repo

2. Install dependency

   ```
   composer install

   npm install
   ```

3. Setup Database

4. Setup Aplications

Rename .env.example to .env and fill the environment variable.

Generate a new key for your local application
```
php artisan key:generate
```

Migrate the table to database
```
php artisan migrate
```

Install Laravel Passport
```
php artisan passport:install
```

Seed User data
```
php artisan db:seed
```

Seed Demo Data

```
php artisan db:seed --class=DemoDataSeeder
```

If you are making changes to JavaScript or Styles make sure you run gulp or gulp watch.

```
gulp
```

## Running the tests

run

```
vendor/bin/phpunit
```

## Todo

- Some Awesome Stuff

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Risal Hidayat** - *Initial work* - [rslhdyt](https://github.com/rslhdyt)
* **Fedrianto Ramadhan** - [madindo](https://github.com/madindo)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the GNU GENERAL PUBLIC LICENSE - see the [LICENSE.md](LICENSE.md) file for details
