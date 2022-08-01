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
      require_once '../app/models/' . $model . '.php';
      // Instantiate model
      return new $model;
   }

   
}
