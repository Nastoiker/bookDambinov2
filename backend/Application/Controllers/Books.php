<?php 

use MVC\Controller;

class ControllersBooks  extends Controller {


    public function setRatingForBook() {
        $param = $this->request->input();
        if(empty($param['authorById'])) {
      $this->response->sendStatus(400);
      $this->response->setContent(['MESSAGE' => 'ERROR']);
        } else {
      $model = $this->model('books');
      $result = $model->setRatingByBookId($param);
      $this->response->sendStatus(201);
      $this->response->setContent($result);
        }
    }
    public function books($param) {

        $model = $this->model('books');
        $book_list = $model->getAllBooks($param);

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
    public function getGenres() {
        $model = $this->model('books');
        $result = $model->getAllGenres();
        $this->response->sendStatus(200);
        $this->response->setContent($result);}
    public function allAuthors() {
        $model = $this->model('books');
        $author_list = $model->Authors();
        $this->response->sendStatus(200);
        $this->response->setContent($author_list);
    }
    public function authors() {

        $model = $this->model('books');
        $author_list = $model->getAllAuthors();

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

        if (isset($param['author']) && $this->validSearchBooks($param['author'])) {

            $model = $this->model('books');
            $result = $model->searchBooksByAuthors($param);

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
                $this->response->setContent($result);
            }
        } else {
            $this->response->sendStatus(400);
            $this->response->setContent([
                'message'   => 'не найден'
            ]);
        }
    }
    public function searchAthorByName() {
        $param = $this->request->input();
        if (isset($param['name'])) {

            $model = $this->model('books');
            $result = $model->searchAthorByName($param);
            if(count($result['result'][0]['author']) === 0) {
                $this->response->sendStatus(404);
                $this->response->setContent([
                    'message'   => 'не найден'
                ]);
            } else {
                $this->response->sendStatus(200);
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

    if (!$param['writtenById']) {
      $this->response->sendStatus(400);
      $this->response->setContent(['MESSAGE' => 'ERROR']);
    } else {
      $model = $this->model('books');
      $result = $model->setCommentByBookId($param);
      $this->response->sendStatus(201);
      $this->response->setContent($result);
    }
     

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

        if (!empty($param) && !is_numeric($param) && strlen((string) $param) > 0)
            return true;
        
        return false;
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
