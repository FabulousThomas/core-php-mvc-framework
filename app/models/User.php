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
      $this->db = new Database;
      $this->createDatabe();
      $this->createTable();
   }

   // Create Database
   public function createDatabe()
   {
      $this->db->query('CREATE DATABASE IF NOT EXISTS `coremvc`');

      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   // Create Table users
   public function createTable()
   {
      $this->db->query('CREATE TABLE IF NOT EXISTS `coremvc`.`users` ( 
         `id` INT NOT NULL AUTO_INCREMENT, 
         `name` VARCHAR(255) NOT NULL, 
         `username` VARCHAR(255) NOT NULL, 
         `email` VARCHAR(255) NOT NULL, 
         `password` VARCHAR(255) NOT NULL, 
         `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
         PRIMARY KEY (`id`)) ENGINE = InnoDB;');

      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

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

   public function login($email, $password)
   {
      $this->db->query('SELECT * FROM users WHERE email = :email AND password = :password');
      // Bind values
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);

      // $row = $this->db->singleSet();

      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }

      // $hashed_password = $row->password;

      // if (password_verify($password, $hashed_password)) {
      //    return $row;
      // } else {
      //    return false;
      // }
   }

   // Check for email
   public function checkEmail($email)
   {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);
      $this->db->singleSet();

      if($this->db->rowCount() > 0) {
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

      if($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }
}
