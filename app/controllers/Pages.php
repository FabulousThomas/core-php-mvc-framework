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

}