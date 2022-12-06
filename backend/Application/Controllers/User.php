<?php 

use MVC\Controller;

class ControllersUser  extends Controller {

    public function Registration() {
        if ($this->request->getMethod() == "POST") {
            $data = $this->request->input();
            $model = $this->model('user');
            $users = $model->registration($data);
            if($users === null) {
                $this->response->sendStatus(401);
                $this->response->setContent(['message' => 'такой пользователь уже существует']);
            } else {
                $data = ['data' => $users];
                $this->response->sendStatus(201);
                $this->response->setContent($data);
            }

        }
    }
    public function getRatingBookByUserId() {
        if ($this->request->getMethod() == "POST") {
            $data = $this->request->input();
            $model = $this->model('user');
            $users = $model->getRatingBookByUserId($data);
            $data = ['rating' => $users];
            if($data['rating'] === null ){
                $this->response->sendStatus(404);
                $this->response->setContent(['message' => 'не найден']);
            } else {
                $this->response->sendStatus(200);
                $this->response->setContent($data);
            }
        }
    }
    public function Auth() {
        if ($this->request->getMethod() == "POST") {
            $data = $this->request->input();
            $model = $this->model('user');
            $users = $model->auth($data);
            $data = ['data' => $users];
            if($data['data'] === null ){
                $this->response->sendStatus(401);
                $this->response->setContent(['message' => 'ошибка авторизации']);
            } else {
                $this->response->sendStatus(201);
                $this->response->setContent($data);
            }
        }
    }
    public function banUser() {
        if ($this->request->getMethod() == "POST") {
            $data = $this->request->input();
            $model = $this->model('user');
                $users = $model->banUser($data);
                if (!($users == 'UserBanned' )) {
                    $data = ['data' => $users];
                    $this->response->sendStatus(201);
                    $this->response->setContent($data);
                }
             else {
                 $data = ['data' => $users];
                $this->response->sendStatus(400);
                $this->response->setContent($data);
            }
        }
    }

    public function uploadImage() {
        if(isset($this->request->files['image'])){
            $image = $this->request->files['image'];
            $errors = array();
            $UserId = $this->request->text['userId'];
            $name = mt_rand();
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];

            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $extensions = array("jpeg","jpg","png");

            if(in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }

            if(empty($errors) == true) {
                move_uploaded_file($file_tmp, UPLOAD . "avatars/" . $name . '.' . $file_ext);
                $model = $this->model('user');
                $res = $model->setAvatar($name . '.' . $file_ext, $UserId);
                $this->response->sendStatus(201);
                $this->response->setContent(['picture' => $name . '.' . $file_ext]);
            } else {
                $this->response->sendStatus(500);
            }
        }
    }
}
