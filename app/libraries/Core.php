<?php
    class Core{
        protected $currentController='Pages';
        protected $currentMethod='index';
        protected $params=[],$params2=[];
        static $URLROOT='';

        public function __construct()
        {

            
            $url=$this->getUrl();
            $this->params2= $url ? array_values($url) : [];
            foreach($this->params2 as $a){
                self::$URLROOT.='../';
            }
            if(isset($url[0])){
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                $this->currentController=ucwords($url[0]);
                unset($url[0]);
            }
        }
            require_once '../app/controllers/'.$this->currentController.'.php';
            $this->currentController=new $this->currentController;
            if(isset($url[1])){
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod=$url[1];
                    unset($url[1]);
                }
            }
            
            $this->params= $url ? array_values($url) : [];
            
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            
        }



        public function getUrl(){
            if(isset($_GET['url'])){
                $url=filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL);
                $url=explode('/',$url);
                return $url;
            }
        }

    }