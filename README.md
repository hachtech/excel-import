#  import excel file to database with mapping


In this tutorial, you will learn how to import excel into a database using the Laravel Excel package.

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)


Clone the repository

    git clone  git@github.com:vishalmandora145/excel-import.git

Switch to the repo folder

    cd excel-import

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    http://localhost/excel-import/dashboard




