<?php 
class Pages extends Controller {
   public function __construct()
   {
      
   }

   public function index() {
      $data = [
         'title' => 'Index (Home Page)',
         'description' => 'Index Page'
      ];
      $this->view('pages/index', $data);
   }

   public function about() {
      $data = [
         'title' => 'About',
         'description' => 'About Page'
      ];
      $this->view('pages/about', $data);
   }
}