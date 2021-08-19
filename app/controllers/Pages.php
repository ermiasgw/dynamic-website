<?php
    class Pages extends Controller{
        public function __construct()
        {
            $this->userModel=$this->model('User');
        }
        public function index(){
            $this->view('index');
        }
        public function login(){

            $data=0;
            if($_SERVER["REQUEST_METHOD"] == "post"){
                $data=1;
                $this->view('login',$data);
            }
            $this->view('login',$data);
        }
        public function register(){
            $data=[
                'uname'=>'SDKS',
                'email'=>'',
                'pass' =>'',
                'confirm' =>'',
                'unameerror' => '',
                'emailerror'=>'',
                'passerror' =>''

            ];
            
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data['uname']=trim($_POST['uname']);
                $data['email']=trim($_POST['email']);
                $data['pass']=trim($_POST['pass']);
                $data['confirm']=trim($_POST['confirm']);

                

                if(empty($data['uname'])){
                    $data['unameerror']='name required';
                }
                if(empty($data['password'])){
                    $data['passerror']='pass required';
                }
                if(empty($data['confirm'])){
                    $data['passerror']='pass required';
                }

                if(empty($data['unameerror']) && empty($data['password']) && empty($data['confirm'])){
                    header('location: '.URLROOT.'/login');
                    /*
                    if($this->userModel->register($data)){
                        header('location: '.URLROOT.'/login');
                    }
                    else
                      
                    die("ooooo");
                    */
                }
                

                


            }


            $this->view('register',$data);
        }
    }