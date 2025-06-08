<?php

session_start();

// DATABASE PARAMS
// define('DB_HOST', 'localhost');
// define('DB_USER', 'YOUR_DATABASE_USERNAME');
// define('DB_PASS', 'YOUR_DATABASE_PASSWORD');
// define('DB_NAME', 'YOUR_DATABASE_NAME');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'coremvc');

// SITE PARAMS
// App root directory
define('APPROOT', dirname(dirname(__FILE__)));
// Url root / EXAMPLE: "https://github.com/FabulousThomas"
define('URLROOT', 'http://localhost/core-php-mvc-framework');
// Site Name
define('SITENAME', 'YOUR_WEB_SITE_NAME');
// App version
define('APPVERSION', '3.1.0');

// CHECK CONNECTION

if (!$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS)) {
   die('UNABLE TO COONECT');
}

// CREATE DATABASE AND TABLES
if ($conn->query('CREATE DATABASE IF NOT EXISTS `coremvc`')) {

   $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

   $conn->query('CREATE TABLE IF NOT EXISTS `coremvc`.`users` ( 
      `id` INT NOT NULL AUTO_INCREMENT, 
      `name` VARCHAR(255) NOT NULL, 
      `username` VARCHAR(255) NOT NULL, 
      `email` VARCHAR(255) NOT NULL, 
      `password` VARCHAR(255) NOT NULL, 
      `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
      PRIMARY KEY (`id`)) ENGINE = InnoDB;');
}
