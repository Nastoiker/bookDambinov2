<?php 

use MVC\Controller;

class ControllersBooks  extends Controller {

    public function index() {

        // Connect to database
        $model = $this->model('books');

        // Read All Books And Authors Data
        $data_list = $model->getAllData();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }
    public function setRatingForBook() {
        $param = $this->request->input();
        $model = $this->model('books');
        $result = $model->setRatingByBookId($param);
        $this->response->sendStatus(201);
        $this->response->setContent($result);
    }
    public function books($param) {

        $model = $this->model('books');
        $book_list = $model->getAllBooks($param);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($book_list);
    }

    public function getBooksByGenre($param) {
        if (isset($param['genreId'])) {

            $model = $this->model('books');
            $result = $model->getBooksByGenresId($param);
            $this->response->sendStatus(200);
            $this->response->setContent($result);
        } else {
            $this->response->sendStatus(200);
            $this->response->setContent([
                'message'   => 'Invalid author name OR Your author name is too short'
            ]);
        }
    }
    public function authors($param) {

        $model = $this->model('books');
        $author_list = $model->getAllAuthors($param);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($author_list);
    }
    public function getbooksbyauthors($param) {
        $model = $this->model('books');
        $authors_list = $model->getAuthorById($param);
        if(!$authors_list) {
            $this->response->sendStatus(404);
            $this->response->setContent(['message' => 'автор не найден']);
        } else {
            $this->response->sendStatus(200);
            $this->response->setContent($authors_list);
        }
    }
    public function searchBooksByAuthors($param) {

        // check valid param
        if (isset($param['author']) && $this->validSearchBooks($param['author'])) {

            $model = $this->model('books');
            $result = $model->searchBooksByAuthors($param);

            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($result);
        } else {
            $this->response->sendStatus(200);
            $this->response->setContent([
                'message'   => 'Invalid author name OR Your author name is too short'
            ]);
        }
    }
    public function searchBooksById($param){
        $model = $this->model('books');
        $result = $model->getBookById((int) $param['id']);
        $this->response->sendStatus(200);
        $this->response->setContent($result);
    }
    public function searchBooksByTitle() {
        $param = $this->request->input();
        // check valid param
        if (isset($param['name']) && $this->validSearchBooks($param['name'])) {

            $model = $this->model('books');
            $result = $model->searchBooksByTitle($param);
            if(count($result['result'][0]['book']) === 0) {
                $this->response->sendStatus(404);
                $this->response->setContent([
                    'message'   => 'не найден'
                ]);
            } else {
                $this->response->sendStatus(200);
                // Send Response
                $this->response->setContent($result);
            }
        } else {
            $this->response->sendStatus(400);
            $this->response->setContent([
                'message'   => 'не найден'
            ]);
        }
    }
    public function setCommentByBookId() {
        $param = $this->request->input();
        $model = $this->model('books');
            $result = $model->setCommentByBookId($param);
            $this->response->sendStatus(201);
            $this->response->setContent($result);

    }
    public function deleteBookId() {
        if ($this->request->getMethod() == "DELETE") {
            $param = $this->request->input();
            $model = $this->model('books');
            $result = $model->deleteBookById($param);
            $this->response->sendStatus(202);
            $this->response->setContent($result);
        }
    }
    private function validSearchBooks($param) {

        // check param
        if (!empty($param) && !is_numeric($param) && strlen((string) $param) > 0)
            return true;
        
        return false;
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
        public function getUserByid() {
            if ($this->request->getMethod() == "POST") {
                $data = $this->request->input();
                $model = $this->model('Books');
                $users = $model->getUserByid($data['id']);
                if($users === null ){
                    $this->response->sendStatus(404);
                    $this->response->setContent(['message' => 'такой id не существует']);
                } else {
                    $this->response->sendStatus(200);
                    $this->response->setContent($users);
                }
            }
        }

}
