<?php
/*
 * Base Controller
 * Loads the models and views
 */
class Controller
{
   // Load Model
   public function model($model)
   {
      // Require model
      require_once APPROOT . '/models/' . $model . '.php';
      // Instantiate model
      return new $model;
   }

   // Load view
   public function view($view, $data = [])
   {
      // Check if view exists
      if (file_exists(APPROOT . '/views/' . $view . '.php')) {
         // Require view
         require_once APPROOT . '/views/' . $view . '.php';
      } else {
         die('View does not exist');
      }
   }
}
