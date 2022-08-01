<?php 
/*
 * Creates Database connection
 * Binds values
 * Query data from database
 * Executes query
 */
class Database {
   private $host = DB_HOST;
   private $user = DB_USER;
   private $pass = DB_PASS;
   private $dbname = DB_NAME;
   private $dbh;
   private $stmt;
   private $error;
}