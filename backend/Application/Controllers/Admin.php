<?php
use MVC\Controller;

class ControllersAdmin  extends Controller {
public function index() { }
    public function getAllUser() {
        $model = $this->model('admin');
        $users = $model->getAllUser();
        $data =  $users;

        $this->response->sendStatus(200);
        $this->response->setContent($data);
    }
    public function deleteBook() {

            $data = $this->request->input();
            $model = $this->model('admin');
            $users = $model->deleteBook($data);
            $this->response->sendStatus(202);
            $this->response->setContent(['message' => 'deleted']);
    }
    public function unban() {

        $data = $this->request->input();
        $model = $this->model('admin');
        $users = $model->unban($data);
        $this->response->sendStatus(201);
        $this->response->setContent(['message' => 'unbaned']);
    }
    public function newAuthor() {
        if ($this->request->getMethod() == "POST") {
            $image = $this->request->files['image'];
            $lastName = $this->request->text['lastName'];
            $firtName = $this->request->text['firstName'];
            $name = mt_rand();
            $check = $this->uploadImageMethod($image, $name, 'authors');
            if(!$check) {
                $this->response->sendStatus(500);
                $this->response->setContent(['message' => 'error']);
            } else {

                $data = [
                    'image' => $check,
                    'lastName' => $lastName,
                    'firstName' => $firtName,
                ];
                $model = $this->model('admin');
                $users = $model->createNewAuthor($data);
                $this->response->sendStatus(201);
                $this->response->setContent(['message' => 'created']);
            }
        }
    }

    private function uploadImageMethod($image, $name, $directory) {
        $file_name = $image['name'];
        $file_size = $image['size'];
        $file_tmp = $image['tmp_name'];
        $file_type = $image['type'];
        $extensions = array("jpeg", "jpg", "png");
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        $resultimage = $name . '.' . $file_ext;
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be exactly 2 MB';
        }

        if (empty($errors) == true) {

            move_uploaded_file($file_tmp, UPLOAD . $directory .'/' . $resultimage);
            return $name . '.'. $file_ext;
        }
        return false;
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
            $releseYear = str_replace("'", '', $releseYear);
            $Name = str_replace("'", '', $Name);
            $description = str_replace("'", '', $description);

            foreach($AuthorId as $key => $value):
                $value = str_replace("'", '', $value);
                $AuthorId[$key] = (int) $value;
            endforeach;
            foreach($GenreId as $key => $value):
                $value = str_replace("'", '', $value);
                $GenreId[$key] = (int) $value;
            endforeach;
            $file_name = $image['name'];
            $name = mt_rand();
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];
            $extensions = array("jpeg", "jpg", "png");
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            $resultimage = $name . '.' . $file_ext;
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

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
    public function createNewGenre() {
        if ($this->request->getMethod() == "POST") {
            $image = $this->request->files['image'];
            $nameGemre = $this->request->text['name'];
            $name = mt_rand();

            $check = $this->uploadImageMethod($image, $name, 'genres');
            if(!$check) {
                $this->response->sendStatus(500);
                $this->response->setContent(['message' => 'error']);
            } else {
                $data = [
                    'image' => $check,
                    'name' => $nameGemre,
                ];
                $model = $this->model('admin');
                $users = $model->createNewGenre($data);
                $this->response->sendStatus(201);
                $this->response->setContent(['message' => 'created']);
            }
        }
    }
    public function getAllComments() {
        $model = $this->model('admin');
        $comments = $model->getAllComments($model);
        $this->response->sendStatus(201);
        $this->response->setContent($comments);
    }
    public function deleteComment() {
        if ($this->request->getMethod() == "POST") {
            $data = $this->request->input();
            $model = $this->model('admin');
            $comments = $model->deleteComment($data['id']);
            $this->response->sendStatus(202);
            $this->response->setContent($comments);
        }
    }
    public function uploadImage()
    {
        if (isset($this->request->files['image'])) {
            $errors = array();
            $BookId = $this->request->text['bookId'];
            $image = $this->request->files['image'];

            $file_name = $image['name'];
            $name = mt_rand();
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            $file_type = $image['type'];
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

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