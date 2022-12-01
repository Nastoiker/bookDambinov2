<?php
use MVC\Controller;

class ControllersAdmin  extends Controller {
public function index() { }
    public function getAllUser() {
        $model = $this->model('admin');
        $users = $model->getAllUser();
        $data =  $users;

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }
    public function deleteBook() {
        if ($this->request->getMethod() == "DELETE") {
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


    public function newAuthor() {
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
    public function deleteComment() {
        if ($this->request->getMethod() == "DELETE") {
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
    public function createBook() {
        if ($this->request->getMethod() == "POST") {
            $image = $this->request->files['image'];
            $AuthorId = $this->request->text['authorId'];
            $GenreId = $this->request->text['GenreId'];
            $Name = $this->request->text['Name'];
            $releseYear = $this->request->text['releseYear'];
            $description = $this->request->text['description'];
            $AuthorId = explode(',', $AuthorId);
            $GenreId = explode(',', $GenreId);
            $file_name = $image['name'];
            $name = mt_rand();
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];
            $extensions = array("jpeg", "jpg", "png");
            $file_ext = explode('.', $file_name);
            $resultimage = $name . '.' . $file_ext;
            // Check it's valid file for upload
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check file size
            if ($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }

            if (empty($errors) == true) {

                move_uploaded_file($file_tmp, UPLOAD . "Images/" . $resultimage);
                $this->response->sendStatus(201);
                $model = $this->model('Admin');
                $data = [
                    'image' => $resultimage,
                    'name' => $Name,
                    'Authors' => $AuthorId,
                    'Genres' => $GenreId,
                    'description' => $description,
                    'releseYear' => $releseYear,
                ];
                $result = $model->createBook($data);
                $this->response->sendStatus(201);
                $this->response->setContent($result);
            } else {
                $this->response->sendStatus(500);
            }

        }
    }
    public function uploadImage()
    {
        if (isset($this->request->files['image'])) {
            $errors = array();
            $BookId = $this->request->text['bookId'];
            $image = $this->request->files['image'];
            // File info

            $file_name = $image['name'];
            $name = mt_rand();
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];
            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            // White list extensions
            $extensions = array("jpeg", "jpg", "png");

            // Check it's valid file for upload
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check file size
            if ($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, UPLOAD . "Images/" . $name . '.' . $file_ext);
                $this->response->sendStatus(201);
                $model = $this->model('Books');
                $res = $model->setPhoto($name . '.' . $file_ext, $BookId);
                $this->response->setContent($res);
            } else {
                $this->response->sendStatus(500);
            }
        }
    }
    public function deleteGenre()
    {
        if ($this->request->getMethod() == "DELETE") {
            $data = $this->request->input();
            $model = $this->model('user');
            $users = $model->banUser($data);
            if (!($users == 'UserBanned')) {
                $data = ['data' => $users];
                $this->response->sendStatus(201);
                $this->response->setContent($data);
            } else {
                $data = ['data' => $users];
                $this->response->sendStatus(400);
                $this->response->setContent($data);
            }
        }
    }
}