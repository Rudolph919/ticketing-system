# Ticketing system
Laravel Ticket Management Application

Please follow the below commands to install the application:

1. Create a local database
2. If you don't have Composer installed, install it. https://getcomposer.org/download/
3. Download the source code
4. Rename the .env.example file to .env inside your project root and fill in the database details of the database created in step 1
5. Add your mail server details in the .env file. If you do not have a mail server and only plan on testing, I would suggest using Mailtrap for email testing. https://mailtrap.io/
6. Open a console and cd to your project root directory
7. Run composer install or php composer.phar install
8. Run php artisan key:generate
9. Run php artisan migrate:fresh --seed
10. Run php artisan serve

You can now access your project at localhost:8000

#Notes
The database that is supposed to work with this application is MSSQL. I had configuration and environment issues while setting up to use MSSQL. It took way too long to set up so I decided to move to a MySQL database as it was super easy to spin up.

The support agent login details is as follows:
[
    'name' => 'Jane Smith',
    'email' => 'janesmith@tickets.com',
    'password' => Hash::make('password2'),
    'role' => 'support agent',
],
[
    'name' => 'Chuck Norris',
    'email' => 'chucknorris@tickets.com',
    'password' => Hash::make('password3'),
    'role' => 'support agent',
],
[
    'name' => 'Support Agent 1',
    'email' => 'supportagent1@tickets.com',
    'password' => Hash::make('password6'),
    'role' => 'support agent',
],
