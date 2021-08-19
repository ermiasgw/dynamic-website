<?php
    class User{
        private $db;
        public function __construct()
        {
            $this->db=new Database;
        }
        public function register($data){
            $this->db->query('INSERT INTO table1(username,PASSWORD) VALUES
            (:uname,:pass)');
            $this->db->bind(':uname',$data['uname']);
            $this->db->bind(':pass',$data['pass']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }