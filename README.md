# DLookup - Darknet Ecommerce Shop


Darkrule is used to sell Drivers License Info, SSNDOB, Email Flooding, Shipping Labels. This project is for training purposes and can also be used for real deal, with coinpayments bitcoin payment gateway


## Installation

It is preferred to have git setup installed on your local system.

Once downloaded/cloned go to the project directory on terminal/command line and install composer:

    composer install

        or
    
    composer update

Once composer is installed, run migration: 

    php artisan migrate

Note: if migration fails to run, install php7 if you are using php8. This laravel version uses php version 7.2.5+

After migration, run the database seeder: 

    php artisan db:seed

Visit https://coinpayments.net - to register as merchant to get merchant API credential for the application.

Coinpayment API integration:
after you register for coinpayment merchant api, run the following Laravel artisan command below to setup the application API intergration

php artisan coinpayment:install 

and complete the rest. you are done.

You can make additional changes in coinpayment.php file in the config folder. 
    
Once done migrating and seeding you will have default user:

    Admin Dashboard
    https://localhost:8000/admin
    email: admin@app.com
    password: 123456789

    User Dashboard
    http://localhost:8000
    create your own account
  