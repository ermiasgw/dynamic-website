<?php
    class Pages extends Controller{
        public function __construct()
        {
            $this->userModel=$this->model('User');
        }
        public function index(){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                if(empty($_GET['search'])){
                    $dat=$this->userModel->slide();
                }
                else{
                    $dat=$this->userModel->search($_GET['search']);
                }
                unset($_GET['search']);
                
                
            }else{
                $dat=$this->userModel->slide();
            }
            $data=[
                'OBJ'=>$dat];
            $this->view('index',$data);
        }
             
    }