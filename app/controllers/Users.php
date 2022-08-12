<?php
class Users extends Controller
{
   private $userModel = '';
   public function __construct()
   {
      $this->userModel = $this->model('User');
   }

   public function login()
   {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         die('FORM ACTION');
      } else {
         $data = [
            'title' => 'Login',
            'description' => 'Please, Login to proceed',
            'username' => '',
            'password' => '',
            'username_err' => '',
            'password_err' => '',
         ];
         $this->view('users/login', $data);
      }
   }

   public function register()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Sanitize input
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Initialize data
         $data = [
            'title' => 'Register',
            'description' => 'Please, Register to Login',
            'name' => trim($_POST['name']),
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'name_err' => '',
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
         ];

         // Validate Inputs
         if (empty($data['name'])) {
            $data['name_err'] = 'Please, enter your full name';
         }
         if (empty($data['username'])) {
            $data['username_err'] = 'Please, enter username';
         }
         if (empty($data['email'])) {
            $data['email_err'] = 'Please, enter email';
         }
         if (empty($data['password'])) {
            $data['password_err'] = 'Please, enter password';
         }

         // Make sure errors are empty
         if (empty($data['name_err']) && empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err'])) {
            flash_msg('register_msg', '<strong>Success!</strong> You can login');
            redirect('users/login');
         } else {
            // Load views with error
            $this->view('users/register', $data);
         }
      } else {
         $data = [
            'title' => 'Register',
            'description' => 'Please, Register to Login',
            'name' => '',
            'username' => '',
            'email' => '',
            'password' => '',
            'name_err' => '',
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
         ];
         $this->view('users/register', $data);
      }
   }
}
