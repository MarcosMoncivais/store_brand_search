DESCRIPTION

This simple app allows the user to enter the names of shoe stores and shoe brands, then tell you which stores sell which brands. Store names can also be updated or deleted.

SET UP

Clone this repository to your local machine.
Install the necessary dependencies via Composer by going into the top project folder from the command line and running composer install.
Import the MYSQL database 
Start a PHP server in the 'web' folder of the project.
Navigate to root path in a web browser.

**DATABASE SETUP**
$ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot;

$ CREATE DATABASE shoes;

$ USE shoes;

$ CREATE TABLE stores (name varchar (255), id serial PRIMARY KEY);

$ CREATE TABLE brands (name varchar (255), id serial PRIMARY KEY);

$ CREATE TABLE brands_stores (brand_id int, store_id int, id serial PRIMARY KEY);



* PHP
* PHPUnit
* MYSQL
* Silex
* Twig
* HTML
LICENSE and COPYRIGHT

MIT License (MIT) Copyright 2015 - Marcos Moncivais

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.