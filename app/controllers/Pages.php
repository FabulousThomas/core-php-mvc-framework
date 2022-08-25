<?php
class Pages extends Controller
{
   private $userModel = '';
   private $data = [];
   // private $username = '';
   public function __construct()
   {
   }

   public function index()
   {
      $this->data = [
         'title' => 'Core PHP-MVC-Framework',
         'description' => 'A simple open source PHP-MVC-Framework'
      ];
      $this->view('pages/index', $this->data);
   }

   public function about()
   {
      $this->data = [
         'title' => 'About this Framework',
         'description' => 'About Page'
      ];
      $this->view('pages/about', $this->data);
   }

   public function success()
   {
      $this->data = [
         'title' => 'Login Success Page',
         'description' => 'Success Page'
      ];
      $this->view('pages/success', $this->data);
   }
}
