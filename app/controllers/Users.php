<?php
class Users extends Controller
{
   private $userModel = '';
   public function __construct()
   {
      $this->userModel = $this->model('User');
   }

   // LOGIN USERS
   public function login()
   {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         // Sanitize inputs
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Initialize data array
         $data = [
            'title' => 'Login',
            'description' => 'Please, Login to proceed',
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',
         ];

         // Validate login inputs
         if (empty($data['email'])) {
            $data['email_err'] = 'Please, enter email';
         } 
         if ($this->userModel->checkEmail($data['email'])) {
            // Success
         } else {
            // Failed
            $data['email_err'] = 'No user for this account';
         }

         if (empty($data['password'])) {
            $data['password_err'] = 'Please, enter password';
         }

         // Make sure errors are empty
         if (empty($data['email_err']) && empty($data['password_err'])) {
            // Success
            $getUsers = $this->userModel->login($data['email'], $data['password']);

            if ($getUsers) {
               flash_msg('users_msg', 'Welcome ' . $data['email']);
               redirect('users/login');
            } else {
               flash_msg('users_msg', 'Incorrect email or password');
               redirect('users/login');
            }
         } else {
            // Load views with error
            $this->view('users/login', $data);
         }
      } else {
         $data = [
            'title' => 'Login',
            'description' => 'Please, Login to proceed',
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',
         ];
         $this->view('users/login', $data);
      }
   }

   // REGISTER USERS
   public function register()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Sanitize input
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Initialize data array
         $data = [
            'title' => 'Create an Account',
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
         } elseif ($data['username'] == $this->userModel->checkUsername($data['username'])) {
            $data['username_err'] = 'This username already exist';
         }
         if (empty($data['email'])) {
            $data['email_err'] = 'Please, enter email';
         } elseif ($data['email'] == $this->userModel->checkEmail($data['email'])) {
            $data['email_err'] = 'This email already exist';
         }
         if (empty($data['password'])) {
            $data['password_err'] = 'Please, enter password';
         } elseif (strlen($data['password']) < 6) {
            $data['password_err'] = 'password must be at least 6 characters';
         }

         // Make sure errors are empty
         if (empty($data['name_err']) && empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err'])) {

            if ($this->userModel->register($data)) {
               flash_msg('users_msg', '<strong>Success!</strong> You can login');
               redirect('users/login');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load views with error
            $this->view('users/register', $data);
         }
      } else {
         $data = [
            'title' => 'Create an Account',
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
