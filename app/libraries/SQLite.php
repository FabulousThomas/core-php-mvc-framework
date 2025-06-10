<?php
class SQLite
{
    private $dbPath = __DIR__ . '/../../database/database.db'; // Adjust the path as needed
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set DSN with SQLite driver and database file path
        $dsn = "sqlite:{$this->dbPath}";

        // PDO options
        $options = [
            PDO::ATTR_PERSISTENT => false, // Disabled by default, enable if needed
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Default fetch mode
            PDO::ATTR_EMULATE_PREPARES => false, // Use native prepares for security
        ];

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, null, null, $options); // No username/password for SQLite
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

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    public function singleSet()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

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

// Example usage
try {
    $db = new SQLite();
    $db->query("SELECT DATETIME('now') AS current_time"); // SQLite uses DATETIME('now')
    $result = $db->resultSet();
    echo "Current server time: " . $result[0]->current_time . " at " . date('h:i A T, l, F j, Y') . "<br>";
} catch (Exception $e) {
    echo $e->getMessage();
}
