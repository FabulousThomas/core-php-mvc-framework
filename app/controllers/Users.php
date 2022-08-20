<?php
class Users extends Controller
{
   private $data = [];
   private $userModel = '';
   public function __construct()
   {
      $this->userModel = $this->model('User');
   }

   // REGISTER USERS
   public function register()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Sanitize input
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Initialize this->data array
         $this->data = [
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
         if (empty($this->data['name'])) {
            $this->data['name_err'] = 'Please, enter your full name';
         }
         if (empty($this->data['username'])) {
            $this->data['username_err'] = 'Please, enter username';
         } elseif ($this->data['username'] == $this->userModel->checkUsername($this->data['username'])) {
            $this->data['username_err'] = 'This username already exist';
         }
         if (empty($this->data['email'])) {
            $this->data['email_err'] = 'Please, enter email';
         } elseif ($this->data['email'] == $this->userModel->checkEmail($this->data['email'])) {
            $this->data['email_err'] = 'This email already exist';
         }
         if (empty($this->data['password'])) {
            $this->data['password_err'] = 'Please, enter password';
         } elseif (strlen($this->data['password']) < 6) {
            $this->data['password_err'] = 'password must be at least 6 characters';
         }

         // Make sure errors are empty
         if (empty($this->data['name_err']) && empty($this->data['username_err']) && empty($this->data['email_err']) && empty($this->data['password_err'])) {

            // Hash password
            // $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

            if ($this->userModel->register($this->data)) {
               flash_msg('users_msg', '<strong>Success!</strong> You can login');
               redirect('users/login');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load views with error
            $this->view('users/register', $this->data);
         }
      } else {
         $this->data = [
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
         $this->view('users/register', $this->data);
      }
   }

   // LOGIN USERS
   public function login()
   {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         // Sanitize inputs
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Initialize data array
         $this->data = [
            'title' => 'Login',
            'description' => 'Please, Login to proceed',
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',
         ];

         // Validate login inputs
         // Validate email
         if ($this->userModel->checkEmail($this->data['email'])) {
            // Success
         } elseif (empty($this->data['email'])) {
            $this->data['email_err'] = 'Please, enter email';
         } else {
            // Failed
            $this->data['email_err'] = 'No user for this account';
         }

         // Validate password
         if (empty($this->data['password'])) {
            $this->data['password_err'] = 'Please, enter password';
         }

         // Make sure errors are empty
         if (empty($this->data['email_err']) && empty($this->data['password_err'])) {
            // Success
            $loginUsers = $this->userModel->login($this->data['email'], $this->data['password']);

            if ($loginUsers) {
               $this->createLoginSession($loginUsers);
            } else {
               $this->data['password_err'] = 'Password is incorrect';
               $this->view('users/login', $this->data);
            }
         } else {
            // Load views with error
            $this->view('users/login', $this->data);
         }
      } else {
         $this->data = [
            'title' => 'Login',
            'description' => 'Please, Login to proceed',
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',
         ];
         $this->view('users/login', $this->data);
      }
   }

   // CHECK LOGGED IN USER
   public function createLoginSession()
   {
      $_SESSION['email'] = $this->data['email'];
      $_SESSION['password'] = $this->data['password'];
      // redirect URL on SUCCESS ->>>
      redirect('pages/success');
   }

   // USER LOGOUT SESSION
   public function logout()
   {
      unset($_SESSION['email']);
      unset($_SESSION['password']);
      session_destroy();
      redirect('users/login');
   }
}
