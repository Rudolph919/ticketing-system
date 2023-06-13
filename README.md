# Ticketing system
Laravel Ticket Management Application

Please follow the below commands to install the application:

1. Connect to the server using SSH. Run the following commands
- sudo apt update
- sudo apt upgrade

2. Install the necessary dependencies:
- sudo apt install apache2          # For Apache HTTP Server
- sudo apt install nginx            # For Nginx HTTP Server
- sudo apt install php php-cli php-fpm php-mbstring php-xml php-zip php-sqlsrv php-pdo-sqlsrv
- sudo apt install mssql-server     # For MSSQL Server

3. Download and install composer globally
- sudo curl -sS https://getcomposer.org/installer | php
- sudo mv composer.phar /usr/local/bin/composer
- sudo chmod +x /usr/local/bin/composer

4. Configure the web server

5. Install and configure MSSQL
- sudo apt install mssql-server

6. Copy the project files to the /var/www/html directory

7. Set permissions:
- sudo chown -R www-data:www-data /var/www/html
- sudo chmod -R 755 /var/www/html/storage
- sudo chmod -R 755 /var/www/html/bootstrap/cache

8. Open the setup-databases-script.sh file and add you sa user password. Save the changes.

9. Run the following command but replace the username and password values with the relevent values.
- sudo ./setup-database.sh username password

10. Rename the .env.example file to .env inside your project root and fill in the database details.

11. Add your mail server details in the .env file. If you do not have a mail server and only plan on testing, I would suggest using Mailtrap for email testing. https://mailtrap.io/

12. Ensure you are in the project root folder.

13. Run composer install or php composer.phar install

14. un php artisan key:generate

15. Run php artisan migrate:fresh --seed

16. Restart the web server

You can now access your project.


The support agent login details is as follows:
[
    'name' => 'Jane Smith',
    'email' => 'janesmith@tickets.com',
    'password' => password2,
    'role' => 'support agent',
],
[
    'name' => 'Chuck Norris',
    'email' => 'chucknorris@tickets.com',
    'password' => password3,
    'role' => 'support agent',
],
[
    'name' => 'Support Agent 1',
    'email' => 'supportagent1@tickets.com',
    'password' => password6,
    'role' => 'support agent',
],
