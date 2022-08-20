<?php

session_start();
function flash_msg($name = '', $message = '', $class = 'alert alert-success')
{
   if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
         if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
         }

         if (!empty($_SESSION[$name . '_class'])) {
            unset($_SESSION[$name . '_class']);
         }

         $_SESSION[$name] = $message;
         $_SESSION[$name . '_class'] = $class;
      } elseif (empty($message) && !empty($_SESSION[$name])) {
         $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
         echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
         unset($_SESSION[$name]);
         unset($_SESSION[$name . '_class']);
      }
   }
}

function isLoggedInUser()
{
   if (isset($_SESSION['email'])) {
      return true;
   } else {
      return false;
   }
}

// Url redirect
function redirect($page)
{
   header('Location: ' . URLROOT . '/' . $page);
}
