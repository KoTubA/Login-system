# Table of Contents

- [Table of Contents](#table-of-contents)
  - [Getting Started](#getting-started)
    - [Requirements](#requirements)
    - [Installation](#installation)
    - [Existing Account(s)](#existing-accounts)
  - [Components](#components)
    - [Languages](#languages)
    - [Development Environment](#development-environment)
    - [External Resources/Plugins](#external-resourcesplugins)
  - [Settings](#settings)
    - [Database connection configuration](#database-connection-configuration)
    - [ReCAPTCHA](#recaptcha)
    - [Adding a new Administrator](#adding-a-new-administrator)

## Getting Started

### Requirements
* PHP
* Apache server
* MySQL
* Bootstrap
* JQuery 



### Installation
1. Import the `/setup/import.sql` file into the current DBMS. This file will also create a database (called `loginsystem`), so no previous action is needed. If the database name needs to be updated, it should be changed in the [configuration file](#database-connection-configuration) where the database title is declared.

### Existing Account(s)
The database already contains a sample `Administrator` account for testing things. Use this or go to the registration page and start creating new accounts.

```php
// Login data for an existing account.

username: admin
password: admin

```

## Components

### Languages

- HTML5
- CSS3
- PHP-7.4
- MySQLi

### Development Environment

- Apache-2.4.41 
- Windows 10

### External Resources/Plugins

- Bootstrap-4.4.1
- JQuery-3.4.1
- Fontello-5.0

## Settings

### Database connection configuration

The file `connect.php` allows you to change the configuration of the connection to DB.

```php
// connect.php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "loginsystem";
 
```

### ReCAPTCHA

The application uses the free Google reCAPTCHA service, which helps you detect abusive traffic on website without any user friction. It returns a score based on the interactions with your website and provides you more flexibility to take appropriate actions.

**In order to configure reCAPTCHA you need to:**
1. Follow the ["Developer's Guide"](https://developers.google.com/recaptcha/intro)
2. After adding your own website and receiving the keys you have to configure the `ReCAPTCHA.php` file.

```php
// ReCAPTCHA.php

define('SITE_KEY', 'my_site_key');
define('SECRET_KEY', 'my_secret_key');
        
```

### Adding a new Administrator

**To create an administrator account:**
1. Create a user account using the registration system.
2. Open DBMS and then manually for the appropriate user, edit the value of the `type` column in the `users` table from `user` to `admin`.

| id | mail | login | password | name | surname | number | type | s_name | picture | g_alt_id | f_alt_id | 
| --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- | --- |
| 1 | admin@gmail.com | admin | ********** |  |  |  | admin | login |  |  |  | 
