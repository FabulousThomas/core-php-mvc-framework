# A CORE PHP MVC FRAMEWORK FOR BUILDING WEB APPLICATIONS

[Smarty Documentation](https://www.smarty.net/documentation)

## Introduction

The "core-php-mvc-framework" is a lightweight PHP MVC framework that is designed to be easy to use and highly customizable. It follows the Model View Controller (MVC) design pattern, which separates application logic, data, and presentation. The framework is built on Core PHP, and it provides a set of libraries and tools that can be used to build web applications quickly and efficiently.

This is a lightweight and flexible PHP framework designed to build robust, scalable and maintainable web applications using the Model View Controller (MVC) architectural pattern.

The Core PHP MVC (Model View Controller) framework allows developers to build dynamic websites using the Model-View-Controller design pattern in PHP.

One of the key features of the "core-php-mvc-framework" is its modular design, which allows developers to easily extend and customize the framework to meet their specific needs. The framework is built using best practices and follows industry standards, making it a reliable and secure choice for building web applications.

In addition to its modular design, the "core-php-mvc-framework" also provides a number of built-in features that can help developers save time and effort. These features include a template engine, a database abstraction layer, and a set of helper functions and libraries.

1. Template engine:
   The framework includes a template engine that can be used to create dynamic and responsive web pages.

2. Database abstraction layer:
   .The framework provides a database abstraction layer that can be used to interact with different types of databases, such as MySQL, PostgreSQL, and Microsoft SQL Server.
   .Connects to MySQL databases using PDO (PHP Data Objects).

3. Set of helper functions and libraries:
   .Functions for handling user sessions, cookies, form data, etc.
   .The framework includes a set of helper functions and libraries that can be used to perform common tasks, such as authentication, authorization, and pagination.

4. Class autoloader:
   .Automatically loads classes when they are called in your code. This means you don't need to include or require files manually - the framework will do it for you automatically.

   .Automatically loads classes when they are needed in the code:
   .This makes it easier to organize your project into multiple files without having to include each file manually.
   .This reduces the need to include files manually with require or include statements.
   .This eliminates the need to include or require each class individually.
   .Automatically loads classes when they are called in the code: This makes it easier to organize your project into multiple files without having to include each file individually. This feature is not available in PHP 5.2 and older versions.
   .Automatically loads classes when they are needed in the script.

5. MVC (Model-View-Controller) structure:
   .Separates application logic into three interconnected components.

6. URL routing system:
   .Generates URLs based on defined routes.

7. Error handling system:
   .Displays detailed error messages if an uncaught exception occurs.

8. Security features:
   .Protects against SQL injection by sanitizing input data.
   .Prevents Cross Site Request Forgery (CSRF) attacks.
   .Protects against Cross Site Scripting (XSS) attacks.

9. Theme support:
   .Allows developers to easily switch between different website designs without modifying core code.

Overall, the "core-php-mvc-framework" is a valuable resource for developers who are looking for a lightweight and flexible PHP MVC framework that can help them build web applications quickly and efficiently.

## SITE SETTINGS

=> Open "app folder" <=
=> Locate "config folder" => Open "config.php" => REPLACE YOUR PAGE LINK || INCLUDING YOUR DATABASE CONNECTIONS <=
=> Locate "public folder" => Open ".htaccess" => Find "RewriteBase" =>
NOTE: IF YOUR SITE IS IN A FOLDER, PUT THE FOLDER NAME THUS: /folder name/public
BUT IF YOUR SITE IS NOT IN A FOLDER, JUST LEAVE IT THUS: /public <=

## Prerequisites for MsSQL

Install SQL Server Drivers: You need the Microsoft Drivers for PHP for SQL Server. Install them via PECL or download from Microsoft’s site.
On Ubuntu: sudo pecl install sqlsrv pdo_sqlsrv and enable in php.ini (e.g., extension=sqlsrv.so, extension=pdo_sqlsrv.so).
On Windows: Enable extension=php_sqlsrv.dll and extension=php_pdo_sqlsrv.dll in php.ini.
Verify Installation: Check with phpinfo() or php -m | grep sqlsrv to ensure the drivers are loaded.
Verification
Test the Connection: Run the example code with valid SQL Server credentials. It should output something like "Current server time: 2025-06-08 11:22:00.000 at 11:22 AM WAT, Sunday, June 08, 2025".
Compatibility: The class works with SQL Server 2008 and above (including Azure SQL) as of 2025, using the sqlsrv driver.
Debugging: If errors occur, print the DSN or use var_dump($result[0]) to inspect returned data.
Potential Issues to Watch
Undefined Constants: Define DB_HOST, etc., to avoid fatal errors.
Driver Availability: The mssql driver won’t work; ensure sqlsrv or dblib is installed.
Persistent Connections: Test PDO::ATTR_PERSISTENT with your server to avoid resource issues.
rowCount(): For SELECT queries, rowCount() may not always return the correct number of rows with the sqlsrv driver. Use SELECT COUNT(*) if needed.
Authentication: SQL Server may require Windows Authentication or SQL Server Authentication. Adjust the DSN or credentials accordingly (e.g., sqlsrv:Server=host,port;Database=dbName;Encrypt=yes;TrustServerCertificate=true for secure connections).

## Prerequisites for SQLite

Install SQLite Extension: Ensure the SQLite PDO driver is enabled in PHP.
On Ubuntu/Debian: sudo apt install php-sqlite3
On Windows: Enable extension=php_pdo_sqlite.dll in php.ini.
Verify with phpinfo() or php -m | grep sqlite.
Database File: Create the SQLite database file if it doesn’t exist (e.g., using sqlite3 database.db in the terminal), or the class will fail to connect.
