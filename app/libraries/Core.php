<?php
/*
 * App Core Class
 * Creates URL & Loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{
   private $currentController = 'Pages';
   private $currentMethod = 'index';
   private $params = [];

   /**
    * Get the URL and set the controller and method
    *
    * @return void
    */
   public function __construct()
   {
      $url = $this->getUrl();

      if ($url) {
         // Look in controller for first value
         if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
            // if file exists, set a controller
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
         }
      }

      // Require a controller
      require_once APPROOT . '/controllers/' . $this->currentController . '.php';
      // Instantiate controller
      $this->currentController = new $this->currentController;

      // Look in controller for second value
      if (isset($url[1])) {
         // Check if method exists in controller
         if (method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
         }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];
      // Call a callback with arrays of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
   }

   /**
    * Get the URL and parse it
    *
    * @return array|bool The URL segments or false if no URL is present
    */
   public function getUrl()
   {
      if (isset($_GET['url'])) {
         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL);
         $url = explode('/', $url);
         return $url;
      }

      return false;
   }

   // public function __construct()
   // {
   //    $url = $this->getUrl();

   //    if ($url) {
   //       // Look in controller for first value
   //       if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
   //          // if file exists, set a controller
   //          $this->currentController = ucwords($url[0]);
   //          // unset 0 index
   //          unset($url[0]);
   //       }
   //    }

   //    // Require a controller
   //    require_once APPROOT . '/controllers/' . $this->currentController . '.php';
   //    // Instantiate controller
   //    $this->currentController = new $this->currentController;

   //    // Look in controller for second value
   //    if (isset($url[1])) {
   //       // Check if method exists in controller
   //       if (method_exists($this->currentController, $url[1])) {
   //          $this->currentMethod = $url[1];
   //          unset($url[1]);
   //       }
   //    }

   //    // Get params
   //    $this->params = $url ? array_values($url) : [];
   //    // Call a callback with arrays of params
   //    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
   // }

   // public function getUrl()
   // {
   //    if (isset($_GET['url'])) {
   //       $url = rtrim($_GET['url'], '/');
   //       $url = filter_var($url, FILTER_SANITIZE_URL);
   //       $url = explode('/', $url);
   //       return $url;
   //    }
   // }
}
