<?php
    class Users extends Controller{
        public function __construct()
        {
            $this->userModel=$this->model('User');
        }

        public function login(){
            $data =[
                'title' => 'logi',
                'uname'=>'',
                'pass' =>'',
                'unameerror' => '',
                'passerror' =>''
            ];
            
            $this->view('users/login',$data);
        }

        public function register() {
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
    
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                  $data = [
                    'username' => trim($_POST['username']),
                    'email' => '',
                    'password' => '',
                    'confirmPassword' => '',
                    'usernameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => ''
                ];
    
                $nameValidation = "/^[a-zA-Z0-9]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
    
                //Validate username on letters/numbers
                if (empty($data['username'])) {
                    $data['usernameError'] = 'Please enter username.';
                } elseif (!preg_match($nameValidation, $data['username'])) {
                    $data['usernameError'] = 'Name can only contain letters and numbers.';
                }
    
                //Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email address.';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Please enter the correct format.';
                } else {
                    //Check if email exists.
                    if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                    }
                }
    
               // Validate password on length, numeric values,
                if(empty($data['password'])){
                  $data['passwordError'] = 'Please enter password.';
                } elseif(strlen($data['password']) < 6){
                  $data['passwordError'] = 'Password must be at least 8 characters';
                } elseif (preg_match($passwordValidation, $data['password'])) {
                  $data['passwordError'] = 'Password must be have at least one numeric value.';
                }
    
                //Validate confirm password
                 if (empty($data['confirmPassword'])) {
                    $data['confirmPasswordError'] = 'Please enter password.';
                } else {
                    if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                    }
                }
    
                // Make sure that errors are empty
                if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
    
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    
                    //Register user from model function
                    if ($this->userModel->register($data)) {
                        //Redirect to the login page
                        header('location: ' . URLROOT . '/users/login');
                    } else {
                        die('Something went wrong.');
                    }
                }
            }
            $this->view('users/register', $data);
        }
    
    }