<?php
    class Users extends Controller{
        
        public function __construct()
        {
            $this->userModel=$this->model('User');
        }
        public function login() {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'usernameError' => '',
                    'passwordError' => '',
                ];
                if (empty($data['username'])) {
                    $data['usernameError'] = 'Please enter a username.';
                }
    
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter a password.';
                }
    
        
                if (empty($data['usernameError']) && empty($data['passwordError'])) {
                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);
    
                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['passwordError'] = 'Password or username is incorrect. Please try again.';
    
                        $this->view('users/login', $data);
                    }
                }
    
            } 
            $this->view('users/login', $data);
        }
    
        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['template'] = $user->template;
            $_SESSION['rank'] = $user->rank;
            header('location:'.Core::$URLROOT);
        }
    
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            header('location:'.Core::$URLROOT.'users/login');
        }

        public function register() {
            $data = [

                'username' => '',
                'email' => '',
                'password' => '',
                'confirm' => '',
                'phone' => '',
                'template' => '',
                'templateError'=>'',
                'phoneError' => '',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmError' => ''
            ];
    
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                  $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']) ,
                    'password' => trim($_POST['password']),
                    'confirm' => trim($_POST['confirm']),
                    'phone' => trim($_POST['phone']),
                    'template' => $_POST['template'],
                    'templateError'=>'',
                    'phoneError' => '',
                    'usernameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmError' => ''
                ];
    
                $nameValidation = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
    
                
                if (empty($data['username'])) {
                    $data['usernameError'] = 'Please enter username.';
                } elseif (!preg_match($nameValidation, $data['username'])) {
                    $data['usernameError'] = 'Name can only contain letters and numbers.';
                }else {
                    
                    if ($this->userModel->findUserByUserName($data['username'])) {
                        $data['usernameError'] = 'username is already taken.';
                    }
                }

                if (empty($data['phone'])) {
                    $data['phoneError'] = 'Please enter phone.';
                }else {
                    
                    if ($this->userModel->findUserByPhone($data['phone'])) {
                        $data['phoneError'] = 'phone is already taken.';
                    }
                }

                if (empty($data['template'])){
                    $data['templateError']='please choose template.';
                }
            
                //Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email address.';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Please enter the correct format.';
                } 
            
    
              
                if(empty($data['password'])){
                  $data['passwordError'] = 'Please enter password.';
                } elseif(strlen($data['password']) < 6){
                  $data['passwordError'] = 'Password must be at least 8 characters';
                } elseif (preg_match($passwordValidation, $data['password'])) {
                  $data['passwordError'] = 'Password must be have at least one numeric value.';
                }
    
                 if (empty($data['confirm'])) {
                    $data['confirmError'] = 'Please enter password.';
                } else {
                    if ($data['password'] != $data['confirm']) {
                        $data['confirmError'] = 'Passwords do not match, please try again.';
                    }
                }
    
                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmError']) && empty($data['templateError']) ) {
    
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
                    if ($this->userModel->register($data)) {
                        header('location:../login');
                    } else {
                        die('Something went wrong.');
                    }
                }
            }
            $this->view('users/register', $data);
        }
    
    }