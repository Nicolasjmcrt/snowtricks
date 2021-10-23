# Snowtricks
OC Project 6 SnowTricks

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/eafb4bda6edf4971b618e4a23b1d9fd3)](https://www.codacy.com/gh/Nicolasjmcrt/snowtricks/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Nicolasjmcrt/snowtricks&amp;utm_campaign=Badge_Grade)
------------------------------------------------------------------------------------------------------------------------------------------------------------
#### PREREQUISITES
------------------------------------------------------------------------------------------------------------------------------------------------------------
Make sure you have Composer installed on your machine

#### INSTALLATION
------------------------------------------------------------------------------------------------------------------------------------------------------------
**Download or clone**

Download zip files or clone the project repository with github => [see GitHub documentation](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository).


**Configure environment**

Create an .env.local file at the root of the project and copy this content:
```
# .env.local
DATABASE_URL="mysql://root:root@localhost:3306/snowtricks?serverVersion=5.7"
APP_ENV=dev
```
*Content should be edited according to user needs*

**Install the project**

If necessary, install Composer by following the [instructions](https://getcomposer.org/download/)
In your cmd, go to the directory where you want to install the project and install dependencies with composer:
```
$ cd your\directory
$ composer install
```
Dependencies should be installed in your project.

In MacOS, please do the following:

In the doctrine.yaml file present in config / packages, enter the following line as shown below:

unix_socket: /Applications/MAMP/tmp/mysql/mysql.sock

```
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'
        unix_socket: /Applications/MAMP/tmp/mysql/mysql.sock
```



**Create the database**

In the terminal, enter the following command to create the database : 

```
php bin/console doctrine:database:create
```




