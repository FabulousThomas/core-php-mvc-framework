<?php 
class Pages extends Controller {
   public function __construct()
   {
      
   }

   public function index() {
      $data = [
         'title' => 'Index Page',
         'description' => 'Index Page'
      ];
      $this->view('pages/index', $data);
   }

   public function about() {
      $data = [
         'title' => 'About Us',
         'description' => 'About Page'
      ];
      $this->view('pages/about', $data);
   }
}