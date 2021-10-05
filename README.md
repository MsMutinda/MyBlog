# Laravel Blog

This project runs with Laravel version 8.4

## Getting started
``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate

# build CSS and JS assets
npm run dev
# or, if you prefer minified files
npm run prod
```

Launch the server:

``` bash
php artisan serve
```

These steps will have the project up and running on your local machine in no time! Access the app by typing in http://localhost:8000 in your browser.