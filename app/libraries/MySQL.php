<?php
/*
 * PDO Database Class
 * Connect to database
 * Bind values
 * Create prepared statements
 * Return rows and result
 */
class MySQL
{
   private $host = DB_HOST; // Define in config file or .env
   private $user = DB_USER;
   private $pass = DB_PASS;
   private $dbname = DB_NAME;
   private $port = 3306; // Default MySQL port, configurable if needed
   private $charset = 'utf8mb4'; // Modern MySQL charset
   private $dbh;
   private $stmt;
   private $error;

   public function __construct()
   {
      // Set DSN with port and charset
      $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";

      // PDO options
      $options = [
         PDO::ATTR_PERSISTENT => false, // Disabled by default, enable if needed
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Default fetch mode
         PDO::ATTR_EMULATE_PREPARES => false, // Use native prepares for security
      ];

      // Create PDO instance
      try {
         $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) {
         $this->error = $e->getMessage();
         // Log error instead of echoing in production
         error_log("Database Connection Error: " . $this->error);
         throw new Exception("Unable to connect to the database. Please try again later.");
      }
   }

   public function query($sql)
   {
      $this->stmt = $this->dbh->prepare($sql);
   }

   // Bind Values
   public function bind($param, $value, $type = null)
   {
      if (is_null($type)) {
         switch (true) {
            case is_int($value):
               $type = PDO::PARAM_INT;
               break;
            case is_bool($value):
               $type = PDO::PARAM_BOOL;
               break;
            case is_null($value):
               $type = PDO::PARAM_NULL;
               break;
            default:
               $type = PDO::PARAM_STR;
         }
      }
      $this->stmt->bindValue($param, $value, $type);
   }
   // Execute the prepared statement
   public function execute()
   {
      return $this->stmt->execute();
   }

   // Get result set as array of object
   public function resultSet()
   {
      $this->execute();
      return $this->stmt->fetchAll();
   }

   // Get single set as object
   public function singleSet()
   {
      $this->execute();
      return $this->stmt->fetch();
   }

   // Get row count
   public function rowCount()
   {
      return $this->stmt->rowCount();
   }

   // Get the last inserted ID
   public function lastInsertId()
   {
      return $this->dbh->lastInsertId();
   }

   // Begin a transaction
   public function beginTransaction()
   {
      return $this->dbh->beginTransaction();
   }

   // Commit a transaction
   public function commit()
   {
      return $this->dbh->commit();
   }

   // Rollback a transaction
   public function rollBack()
   {
      return $this->dbh->rollBack();
   }

   // Destructor to close connection (optional)
   public function __destruct()
   {
      $this->dbh = null; // PDO closes connection automatically
   }
}
