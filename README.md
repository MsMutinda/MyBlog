# Laravel Blog

This project runs with Laravel version 8.4

## Current functionality
 - CRUD operations on blog posts
 - Publishing/Susepnding blogs
 - Mail notifications whenever a new blog is posted or when a blog gets published
 - Commenting on blogs and replying to comments
 - Approving/Rejecting comments
 - Liking blogs and comments posted
 - Assigning access roles & permissions to users
 - User subscriptions for new blog notifications
 
#
# Getting started
``` bash
# install dependencies
composer install
npm install

# create .env file and generate the application key
cp .env.example .env
php artisan key:generate

# build CSS and JS assets
npm run dev
```

#

### Run the following command to continously check for changes in your css & js files and compile your assets whenever a change occurs

```bash
npm run watch
```
#### Always run the above command whenever you are running the development server.

#


### To launch the server:

``` bash
php artisan serve
```
#

These steps will have the project up and running on your local machine in no time! Access the app by typing in http://localhost:8000 or http://127.0.0.1:8000 in your browser.