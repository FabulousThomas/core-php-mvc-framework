<?php
/*
 * Creates Database connection
 * Binds values
 * Query data from database
 * Executes query
 */
class Database
{
   private $host = DB_HOST;
   private $user = DB_USER;
   private $pass = DB_PASS;
   private $dbname = DB_NAME;
   private $dbh;
   private $stmt;
   private $error;

   public function __construct()
   {
      // Set DSN (Database String Name);
      $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->dbname;
      $options = array(
         PDO::ATTR_PERSISTENT => true,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      );

      // Create PDO instance
      try {
         $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) {
         $this->error = $e->getMessage();
         echo $this->error;
      }
   }

   // Bind values
   public function bind($param, $value, $type = null)
   {
      if (is_null($type)) {
         switch (true) {
            case is_null($type):
               $value = PDO::PARAM_NULL;
               break;
            case is_int($type):
               $value = PDO::PARAM_INT;
               break;
            case is_bool($type):
               $value = PDO::PARAM_BOOL;
               break;
            default:
               $value = PDO::PARAM_STR;
         }
      }
      $this->stmt->bindValue($param, $value, $type);
   }

   // Sql query
   public function query($sql) {
      $this->stmt = $this->dbh->prepare($sql);
   }

   // Execute statement
   public function execute() {
      return $this->stmt->execute();
   }

   // Get row count
   public function rowCount() {
      return $this->stmt->rowCount();
   }

   // Get result set with array of object
   public function resultSet() {
      $this->stmt->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
   }


}
