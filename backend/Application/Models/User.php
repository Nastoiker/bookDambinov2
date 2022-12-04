<?php
use MVC\Model;
class ModelsUser extends Model {


        public function registration($param) {
            $email = strval($param['email']);
            $login = $param['login'];
            $password = md5($param['password']);
            $query = $this->db->query("select * from usermodel where email='$email'");
            if($query->num_rows) {
                return null;
            } else {
                $sql = "INSERT INTO `usermodel` (`id`, `email`, `login`, `password`) VALUES (null, '$email' ,  '$login' , '$password' )";
                $this->db->query($sql);
                $queryId = $this->db->query("SELECT id, image FROM usermodel WHERE email = '$email'" );
                return [
                    'login'      => $param['login'],
                    'email'    => $param['email'],
                    'avatar' => $queryId->row['image'],
                    'id' => $queryId->row['id'],
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
            $query = $this->db->query("select id, email, login, status, image, role from usermodel where email = '$email' and password = '$password'");
            if($this->checkBan($query->row['id'])) {
                return null;
            }
            if(!$query->num_rows) {
                return null;
            }
            return $query->row;
        }
        public function banUser($param) {
            if($this->checkBan($param['id']) === true) {
                return 'allreadyBanned'. $param['id'];
            }
            $this->db->query("update usermodel set status ='banned' where id =" . $param['id'] ."");
            return 'UserBanned' . $param['id'];
        }

        private function checkBan($id): bool
        {
            $query = $this->db->query("select status  from usermodel  where id = " . $id ."");
            if(!($query->row['status'] === 'banned')) {
                return false;
            } else { return true; }
        }
}