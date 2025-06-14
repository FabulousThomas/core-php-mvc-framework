<?php
class Pages extends Controller
{
   private $userModel = '';
   private $data = [];
   // private $username = '';
   public function __construct()
   {
      // You can initialize any models or libraries here if needed
      // $this->userModel = $this->model('User');
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
