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
   public function createDatabe() {
      $this->db->query('CREATE DATABASE IF NOT EXISTS `coremvc`');
   
      if($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   // Create Table
   public function createTable() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `coremvc`.`users` ( 
         `id` INT NOT NULL AUTO_INCREMENT , 
         `name` VARCHAR(255) NOT NULL , 
         `username` VARCHAR(255) NOT NULL , 
         `email` VARCHAR(255) NOT NULL , 
         `password` VARCHAR(255) NOT NULL , 
         `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
         PRIMARY KEY (`id`)) ENGINE = InnoDB;');

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
