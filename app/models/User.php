<?php
    class User{
        private $db;
        public function __construct()
        {
            $this->db=new Database;
        }
        public function register($data){
            if($data['template']=='a'){
                $this->db->query('INSERT INTO users(username,email,phone,PASSWORD,template) VALUES
                (:uname,:email,:phone,:pass,:template);INSERT INTO template_a(username) VALUES(:uname);');
            }elseif($data['template']=='b'){
                $this->db->query('INSERT INTO users(username,email,phone,PASSWORD,template) VALUES
                (:uname,:email,:phone,:pass,:template);INSERT INTO template_b(username) VALUES(:uname);');
            }elseif($data['template']=='c'){
                $this->db->query('INSERT INTO users(username,email,phone,PASSWORD,template) VALUES
                (:uname,:email,:phone,:pass,:template);INSERT INTO tempwlate_c(username) VALUES(:uname);');
            }
            $this->db->bind(':uname',$data['username']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':phone',$data['phone']);
            $this->db->bind(':pass',$data['password']);
            $this->db->bind(':template',$data['template']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function findUserByUserName($username) {
            
            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
        public function findUserByPhone($phone) {
            
            $this->db->query('SELECT * FROM users WHERE phone = :phone');
            
            $this->db->bind(':phone', $phone);
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function login($username, $password) {
            $this->db->query('SELECT * FROM users WHERE username = :username');
    
            $this->db->bind(':username', $username);
    
            $row = $this->db->single();
    
            $hashedPassword = $row->PASSWORD;
    
            if (password_verify($password, $hashedPassword)) {
                return $row;
            } else {
                return false;
            }
        }

        public function view($username,$template){
            if($template=='template_a'){
                $this->db->query('SELECT * FROM template_a WHERE username = :username');
            }
            elseif($template=='template_b'){
                $this->db->query('SELECT * FROM template_b WHERE username = :username');
            }
            elseif($template=='template_c'){
                $this->db->query('SELECT * FROM template_c WHERE username = :username');
            }
            
            
            $this->db->bind(':username', $username);
            $row = $this->db->single();
            return $row;
        }
        public function slide(){
            $this->db->query('SELECT * FROM users ORDER BY users.rank DESC LIMIT 15');
            $dat=$this->db->resultSet();
            if($dat){
                return $dat;
            }
            else{
                return false;
            }

        }

        public function rank($username){

            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();
            $rank=($row->rank)+1;

            $this->db->query('UPDATE users SET users.rank=:rank2 WHERE username=:username');
            $this->db->bind(':username', $username);
            $this->db->bind(':rank2', $rank);
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        public function search($search){
            $this->db->query('SELECT * FROM users WHERE username LIKE :username ORDER BY users.rank DESC LIMIT 15 ');
            $this->db->bind(':username', '%'.$search.'%');
            $dat=$this->db->resultSet();
            if($dat){
                return $dat;
            }
            else{
                return false;
            }
        }
    }