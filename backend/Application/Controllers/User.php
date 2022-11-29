<?php 

use MVC\Controller;

class ControllersUser  extends Controller {
    public function index() {

        // Connect to database
        $model = $this->model('user');

        // Read All Task
        $users = $model->getAllUser();

        // Prepare Data
        $data = ['data' => $users];

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }

    public function post() {

        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $model = $this->model('user');

            // Read All Task
            $users = $model->getAllUser();

            // Prepare Data
            $data = ['data' => $users];

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data);
        }
    }
    public function Registration() {
        if ($this->request->getMethod() == "POST") {
            // Connect to database
            $data = $this->request->input();
            $model = $this->model('user');
            // Read All Task
            $users = $model->registration($data);
            if($users === null) {
                $this->response->sendStatus(401);
                $this->response->setContent(['message' => 'такой пользователь уже существует']);
            } else {
                $data = ['data' => $users];
                $this->response->sendStatus(201);
                $this->response->setContent($data);
            }
            // Prepare Data

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
        if ($this->request->getMethod() == "PUT") {
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
            $image = $this->request->files['image'];
            // File info
            $name = mt_rand();
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];

            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            // White list extensions
            $extensions = array("jpeg","jpg","png");

            // Check it's valid file for upload
            if(in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check file size
            if($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }

            if(empty($errors) == true) {
                move_uploaded_file($file_tmp, UPLOAD . "avatars/" . $name . '.' . $file_ext);
                $model = $this->model('user');
                $res = $model->setAvatar($name . '.' . $file_ext, $UserId);
                $this->response->sendStatus(201);
            } else {
                $this->response->sendStatus(500);
            }
        }
    }
}
