<?php
/*
 * App Core Class
 * Creates URL & Loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{
   private $defaultController = 'Index';
   private $defaultMethod = 'Index';
   private $currentController;
   private $currentMethod;
   private $params = [];

   public function __construct()
   {
      $this->currentController = $this->defaultController;
      $this->currentMethod = $this->defaultMethod;

      $url = $this->getUrl();

      if ($url) {
         // Validate and load controller
         if (isset($url[0]) && $this->isValidName($url[0])) {
            $controllerFile = APPROOT . '/controllers/' . ucwords($url[0]) . '.php';
            if (file_exists($controllerFile)) {
               $this->currentController = ucwords($url[0]);
               unset($url[0]);
            } else {
               throw new Exception("Controller file not found: " . $controllerFile);
            }
         }
      }

      // Instantiate controller (always)
      require_once APPROOT . '/controllers/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;

      // Validate and set method
      if ($url && isset($url[1]) && $this->isValidName($url[1])) {
         if (method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
         } else {
            throw new Exception("Method {$url[1]} not found in controller {$this->currentController}");
         }
      }

      // Set parameters
      $this->params = $url ? array_values($url) : [];

      // Call method
      $this->currentController->{$this->currentMethod}(...$this->params);
   }

   private function isValidName($name)
   {
      return preg_match('/^[a-zA-Z0-9_]+$/', $name);
   }

   public function getUrl()
   {
      if (isset($_GET['url'])) {
         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL);
         return explode('/', $url);
      }

      return [];
   }
}
