<?php
use MVC\Model;
class ModelsUser extends Model {

    public function getAllUser() {
        // can you connect to database
        // $this->db->query( write your sql syntax: "SELECT * FROM " . DB_PREFIX . "user");
    }
        public function registration($param) {
            $email = $param['email'];
            $login = $param['login'];
            $password = md5($param['password']);
            $query = $this->db->query("select * from usermodel where email = '$email'");
            if($query->num_rows) {
                return null;
            } else {
                $sql = "INSERT INTO `usermodel` (`id`, `email`, `login`, `password`) VALUES (null, '$email' ,  '$login' , '$password' )";
                $this->db->query($sql);
                return [
                    'login'      => $param['login'],
                    'email'    => $param['email'],
                ];
            }
        }
        public function setAvatar($img, $id) {
            $sql = "UPDATE usermodel SET image = '$img' where id = '$id'";
            $query = $this->db->query($sql);
            return ['picture' => $img];
        }
        public function auth($param) {
            $adminUser = 'damur2004@gmail.com';
            $adminPasword = 'lol';
            if(($param['email'] === $adminUser) && $param['password'] === $adminPasword ) { return 'admin'; };
            $email = $param['email'];
            $password = md5($param['password']);
            $query = $this->db->query("select id, email, login from usermodel where email = '$email' and password = '$password'");
            if($query->num_rows) {
                return $query->row;
            } else {
                return null;
            }
        }
}