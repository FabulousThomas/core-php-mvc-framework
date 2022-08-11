<?php 
class Pages extends Controller {
   public function __construct()
   {
      
   }

   public function index() {
      $data = [
         'title' => 'Core PHP MVC Framework',
         'description' => 'A simple open source Core PHP MVC Framework'
      ];
      $this->view('pages/index', $data);
   }

   public function about() {
      $data = [
         'title' => 'About this Framework',
         'description' => 'About Page'
      ];
      $this->view('pages/about', $data);
   }
}