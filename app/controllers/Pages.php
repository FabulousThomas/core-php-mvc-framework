<?php
class Pages extends Controller
{
   private $userModel = '';
   // private $data = [];
   // private $username = '';
   public function __construct()
   {
      /* 
       * redirects users to login page
       * if not logged in
       */
      // if (!isLoggedInUser()) {
      //    redirect('pages/success');
      // }
      $this->userModel = $this->model('User');
   }

   public function index()
   {
      if(isLoggedInUser()) {
         redirect('pages/success');
      }
      $data = [
         'title' => 'Core PHP-MVC-Framework',
         'description' => 'A simple open source PHP-MVC-Framework'
      ];
      $this->view('pages/index', $data);
   }

   public function about()
   {
      $data = [
         'title' => 'About this Framework',
         'description' => 'About Page'
      ];
      $this->view('pages/about', $data);
   }

   public function success()
   {
      $data = [
         'title' => 'Login Success Page',
         'description' => 'Success Page'
      ];
      $this->view('pages/success', $data);
   }
}
