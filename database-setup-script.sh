#!/bin/bash

# Check if the script is being run as root
if [[ $EUID -ne 0 ]]; then
    echo "This script must be run as root."
    exit 1
fi

# Read username and password as parameters
username=$1
password=$2

# SQL commands to create the database and grant privileges
sql_commands="
CREATE DATABASE ticket_system;
USE your_database_name;
CREATE LOGIN $username WITH PASSWORD = '$password';
CREATE USER $username FOR LOGIN $username;
GRANT ALL PRIVILEGES TO $username;
"

# Execute SQL commands using the sqlcmd utility
echo "$sql_commands" | sqlcmd -S localhost -U sa -P your_sa_password

# Display success message
echo "Database created successfully."
