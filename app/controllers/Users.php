<?php 
class Users extends Controller {
   public function __construct()
   {
      
   }

   public function login() {
      $data = [
         'title' => 'Login',
         'description' => 'Please, Login to proceed',
      ];
      $this->view('users/login', $data);
   }

   public function register() {
      $data = [
         'title' => 'Register',
         'description' => 'Please, Register to Login',
      ];
      $this->view('users/register', $data);
   }
}