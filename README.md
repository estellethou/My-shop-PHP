# All Stars my shop

All Stars my shop is a template of a concept store using HTML, CSS, PHP and MySQL only. You can display products and categories, sign-in and sign-up, save users in database, use an admin page to manage your database. Here is an example of a concept store displaying Chrismas present for people who don't have a lot of money but a great sense of humor 

## Installation

Download the latest PHP 5 ZIP package from www.php.net/downloads.php.
Copy ```C:\php\php.ini-development``` to ```C:\php\php.ini```

Define the extension directory:```extension_dir = "C:/php/ext"```. 

Enable extensions: 
```extension=mysql``` and ```extension=pdo_mysql```

Configure PHP as an Apache module : 

Ensure Apache is not running (use ```net stop  Apache2.2```from the command line) and open its ```confhttpd.conf``` configuration file in an editor. The following lines should be changed:

On line 239, add index.php as a default file name:

```DirectoryIndex index.php index.html```

At the bottom of the file, add the following lines (change the PHP file locations if necessary):

```# PHP5 module```

```LoadModule php5_module "c:/php/php5apache2_2.dll"```

```AddType application/x-httpd-php .php```

```PHPIniDir "C:/php"```

Save the configuration file and test it from the command line (Start > Run > cmd):

```cd Apache2bin```

```httpd -t```

You also need to install mySQL : https://dev.mysql.com/doc/mysql-installation-excerpt/8.0/en/windows-install-archive.html
## Usage

```bash
php -S localhost:8000;
```
Then open a browser with the url :

```http://localhost:8000/index.php```, ```http://localhost:8000/signin.php```, ```http://localhost:8000/signup.php```, ```http://localhost:8000/admin.php```. 

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)

## Authors and acknowledgment
Thanks to Jean-Baptiste, Kobi and Estelle who have contributed to this project. 
