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
   }

   public function createDatabe() {
      $this->db->query('CREATE DATABASE IF NOT EXISTS phpmvc');
   
      if($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   public function register($data)
   {
      $this->db->query('INSERT INTO users () VALUES (:name, :username, :email, :password)');
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      if($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
