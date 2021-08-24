<?php
    class Templates extends Controller{
        public function __construct()
        {
            $this->userModel=$this->model('User');
        }
        public function a($username=''){
            $dat=$this->userModel->view($username,'template_a');
            if($dat){
                $data=[
                    'name' => $dat->name,
                ];
            $this->userModel->rank($username);
        }
        else{
            $data=[
                'name' => '',
            ];

        }
            return $this->view('templates/a',$data);
        }

        public function b($username='1'){
        }
        public function c($username='1'){
        }

}