<?php 

use MVC\Model;

class ModelsBooks extends Model {

    public function getAllData() {
        return [$this->getAllBooks(null), $this->getAllAuthors(null)];
    }


    public function getAllBooks($param) {

        $sql = "SELECT * FROM book";






        $query = $this->db->query($sql);

        $data = [];

        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data['books'][] = [
                        'book'    => $value,
                        'authors' => $this->getAuthorsBook($value['id']),
                     'comment' => $this->getCommentBookById($value['id']),
                    'ratingAvg' => (float) $this->getRatingBookById($value['id'])['round(AVG(rating),1)'],
                    'ratingCount' => (int) $this->getRatingBookById($value['id'])["COUNT(rating)"]
                    ];
            endforeach;
        } else {
            $data['books'][] = [
                'book'       => array(),
                'authors'    => array()
            ];
        }

        return $data;
    }
    public function Authors() {
        $sql = "SELECT * FROM authors";
        $res = $this->db->query($sql);
        return $res->rows;
    }
    public function getAllAuthors() {
        $sql = "SELECT * FROM authors";


        $query = $this->db->query($sql);

        $data = [];

        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $value['rating_Author'] = $this->getAuthorById($value)['rating_author'];
                     $value['countBook'] = $this->getAuthorById($value)['count_book'];
                $value['countRating'] = $this->getAuthorById($value)['count_rating'];
                $data[] = $value;
            endforeach;
        } else {
            $data['authors'][] = [
                'author'   => array(),
                'books'    => array()
            ];
        }
        return $data;
    }
    public function searchBooksByAuthors($param) {
        $sql = "SELECT * FROM authors WHERE fullname LIKE '%" . $this->db->escape($param['author']) . "%'";



        $query = $this->db->query($sql);

        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data['result'][] = [
                    'author'   => $value,
                    'books'    => $this->getBooksAuthor($value['id']),
                ];
            endforeach;
        } else {
            $data['result'][] = [
                'author'   => array(),
                'books'    => array()
            ];
        }

        return $data;
    }

    public function searchAthorByName($param) {
        $sql = "SELECT * FROM authors WHERE firstName LIKE '%" . $this->db->escape($param['name']) . "%' or lastname LIKE '%" . $this->db->escape($param['name']) . "%'";

        

        $query = $this->db->query($sql);

        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data['result'][] = [
                        'author'   => $value,
                    ];
            endforeach;
        } else {
            $data['result'][] = [
                'author'   => array(),
            ];
        }

        return $data;
    }

    public function searchBooksByTitle($param)
    {
        $like = urldecode( $this->db->escape($param['name']));
        $sql = "SELECT * FROM book WHERE name LIKE '%' '$like' '%'";
        

        $query = $this->db->query($sql);

        $data = [];

        if ($query->num_rows) {
            foreach ($query->rows as $key => $value):
                $data['result'][] = [
                    'book' => $value,
                    'authors' => $this->getAuthorsBook($value['id']),
                    'comment' => $this->getCommentBookById($value['id']),
                    'ratingAvg' => (int) $this->getRatingBookById($value['id'])['round(AVG(rating),1)'],
                    'ratingCount' => (int) $this->getRatingBookById($value['id'])["COUNT(rating)"]
                ];
            endforeach;
        } else {
            $data['result'][] = [
                'book' => array(),
                'authors' => array()
            ];
        }

        return $data;
    }
    public function deleteBookById($id) {

        $query = $this->db->query("DELETE FROM book where id=" . $id);
        return 'correct';
    }
    public function setCommentByBookId($param) {
        $date = date("Y-m-d H:i:s");;
        $comment =$param['comment'];
        $writtenById = $param["writtenById"];
        $bookId = $param["bookId"];
        $query = $this->db->query("INSERT INTO `comment`(`id`, `createdAt`, `comment`, `writtenById`, `bookId`) VALUES (null,'$date','$comment','$writtenById','$bookId')");
        return 'correct';
    }
    public function setRatingByBookId($param) {
        $date = date("Y-m-d H:i:s");;
        $authorById = $param["authorById"];
        $bookId = $param["bookId"];
        $rating = $param["rating"];
        $query = $this->db->query("SELECT * from rating where authorId ='$authorById' and bookId= '$bookId'");
        if ($query->num_rows) {
            return 'lol';
            $this->db->query("UPDATE `rating` SET `rating`='$rating' WHERE authorId = '$authorById' and bookId= '$bookId'");
        } else {
            $query = $this->db->query("INSERT INTO `rating`(`id`, `createdAt`, `updatedAt`, `bookId`, `authorId`, `rating`) VALUES (null,'$date','$date','$bookId','$authorById','$rating')");
        }
        return 'correct';

    }
    public function getBooksByGenresId($param) {
        $query =  $this->db->query("SELECT * FROM genresonbook INNER JOIN genres on genres.id = genresonbook.genresId INNER JOIN book on book.id = genresonbook.bookId WHERE genresonbook.genresId = " . (int) $param['genreId'] );
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $result):
                $data[]=$this->getBookById($result['bookId']);
            endforeach;
        }
        return $data;
    }
    private function getGenres($id) {
//        $query  = $this->db->query("SELECT * FROM  genresonbook  where bookId =" . (int) $id) ;
        $query =  $this->db->query("select name from genresonbook INNER JOIN genres  on genres.id = genresonbook.genresId  where bookId =" .  $id . "") ;
        return $query->row;
    }
    public function getAllGenres() {
        $query =  $this->db->query("SELECT `id`, `name`, `img` FROM `genres`");
        return $query->rows;
    }
    private function getCommentBookById($id) {
        $query  = $this->db->query("SELECT * FROM  comment  where  bookId=" . (int) $id );
        $data = [];
        $check = -1;
        if ($query->num_rows) {
            foreach($query->rows as $result):
                if($result['writtenById'] !== $check ) {
                    $comment['commentsAuthor'] = $this->commentByUserId($result['writtenById'], $result['bookId']);
                    $comment['author'] = $this->getUser($result['writtenById']);
                    $check = $result['writtenById'];
                    array_push($data, $comment);
                }
            endforeach;
        }
        return $data;
    }
    private function getRatingBookById($id) {
        $query  = $this->db->query("SELECT round(AVG(rating),1), COUNT(rating) FROM  rating  where bookId =" . (int) $id) ;

        return $query->row;
    }
    private function commentByUserId($UserId, $bookId) {
        $query  = $this->db->query("SELECT * FROM  comment  where  writtenById =" . (int) $UserId .  " and bookId =" . (int) $bookId );
        return $query->rows;
    }
    public function getAuthorById($param) {
        $query =  $this->db->query("SELECT * FROM authorsonbook INNER JOIN authors on `authors`.`id` = `authorsonbook`.`authorsId` 
          INNER JOIN book on `book`.`id` = `authorsonbook`.`bookId` WHERE `authorsonbook`.`authorsId` = " . (int) $param['id'] );
        $data = [];
        $count = 0;
        $countrating = 0;
        $sumrating = 0;
        if ($query->num_rows) {
            foreach($query->rows as $result):
                $author['rating'] = $this->getRatingBookById($result['bookId']);
                $sumrating+= (float) $author['rating']["round(AVG(rating),1)"];
                $countrating += (int)  $author['rating']["COUNT(rating)"];
                $author['book'] = $this->getBook($result['bookId']);
                if( $author['rating']['round(AVG(rating),1)'] !== null) { $count++; }
                array_push($data, $author);
            endforeach;
        } else {
            $query =  $this->db->query("SELECT * FROM authors WHERE id=". (int) $param['id']);
            $resultarr = $query->row;
            $resultarr['count_book'] = 0;
            $resultarr['books'] = 0;
            $resultarr['count_rating'] = 0;
            $resultarr['rating_author'] = 0;
            return $resultarr;
        }
        $queryAuthor =  $this->db->query("SELECT * FROM authors WHERE id=" . $query->row['authorsId']  );
        if($count === 0) {
            $rating = 0;
        } else {
            $rating =  $sumrating / $count;
        }
        $resultarr = $queryAuthor->row;
        $resultarr['count_book'] = count($data);
        $resultarr['books'] = $data;
        $resultarr['count_rating'] = $countrating;
        $resultarr['rating_author'] = round($rating, 1);
        return $resultarr;
    }

    public function getBookById($id) {
        $query = $this->db->query("SELECT * FROM book WHERE id = " . (int) $id . "");
        if ($query->num_rows) {
            foreach($query->rows as $result):
                $book = $query->row;
                $book['author'] = $this->getAuthorsBook($id);
                $book['genres'] = $this->getGenres($id);
                $book['comment'] = $this->getCommentBookById($id);
                $book['rating'] = $this->getRatingBookById($id);
            endforeach;
        }
        return $book;
    }
    private function getUser($id) {
        $query = $this->db->query("SELECT id, email, login, image, status, role FROM usermodel WHERE id = " . (int) $id . "");

        return $query->row;
    }
    private function getBooksAuthor($author) {
        $query = $this->db->query("SELECT * FROM authorsonbook WHERE authorsId = " . (int) $author . "");

        $data = [];

        if ($query->num_rows) {
            foreach($query->rows as $result):
                $book = $this->getBook($result['bookId']);

                array_push($data, $book);
            endforeach;
        }

        return $data;
    }

    private function getBook($book_id) {
        $query = $this->db->query("SELECT * FROM book WHERE id = " . (int) $book_id . "");

        return $query->row;
    }

    private function getAuthorsBook($book_id) {
        $query = $this->db->query("SELECT * FROM authorsonbook WHERE bookId = " . (int) $book_id . "");

        $data = [];

        if ($query->num_rows) {
            foreach($query->rows as $result):
                $author = $this->getAuthor($result['authorsId']);
                array_push($data, $author);
            endforeach;
        }

        return $data;
    }

    private function getAuthor($author_id) {
        $query = $this->db->query("SELECT * FROM  authors WHERE id = " . (int) $author_id . "");
        return $query->row;
    }

    private function getCountBooks() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM book");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }

    private function getCountAuthors() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM authors");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }
    public function getUserByid($id) {
        $query = $this->db->query("select * from usermodel where id=" . $id);
        if(!$query->num_rows) {
            return null;
        } else {
            return $query->row;
        }
    }
}
