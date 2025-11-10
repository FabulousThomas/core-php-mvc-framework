<?php
/*
 * User model
 * Creates Database instance
 * Handles users details
 * Register users
 * Inserts into users table
 */
class User
{
   private $db;

   public function __construct()
   {
      $this->db = new MySQL; // Assuming MySQL is the database class used
   }

   // Users register (USE CASE)
   public function register($data)
   {
      $this->db->query('INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute query
      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   // Users login (USE CASE)
   public function login($email, $password)
   {
      $this->db->query('SELECT * FROM users WHERE email = :email AND password = :password');
      // Bind values
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);

      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }

      // Uncomment the following lines if you want to use password hashing
      // $this->db->query('SELECT * FROM users WHERE email = :email');
      // $this->db->bind(':email', $email);
      // // Get the user row
      // $row = $this->db->singleSet();
      // // Check if the user exists
      // if ($this->db->rowCount() == 0) {
      //    return false; // User not found
      // }
      // // // Get the hashed password from the row
      // if (!$row) {
      //    return false; // User not found
      // } else {
      //    // Verify the password
      //    $hashed_password = $row->password;

      //    if (password_verify($password, $hashed_password)) {
      //       return $row;
      //    } else {
      //       return false;
      //    }
      // }
   }

   // Check for email
   public function checkEmail($email)
   {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);
      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   // Check for username
   public function checkUsername($username)
   {
      $this->db->query('SELECT * FROM users WHERE username = :username');
      $this->db->bind(':username', $username);
      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function getUserById($id)
   {
      $this->db->query('SELECT * FROM users WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->singleSet();

      return $row;
   }

   // Check for Password
   public function checkPassword($password)
   {
      $this->db->query('SELECT * FROM users WHERE password = :password');
      $this->db->bind(':password', $password);
      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   public function select($query, $params = [])
   {
      $this->db->query($query);
      if (!empty($params)) {
         foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
         }
      }
      return $this->db->resultSet();
   }
}
