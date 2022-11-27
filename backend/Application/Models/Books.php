<?php 

use MVC\Model;

class ModelsBooks extends Model {

    public function getAllData() {
        return [$this->getAllBooks(null), $this->getAllAuthors(null)];
    }

    public function setPhoto($img, $id) {
        $sql = "UPDATE book SET img = '$img' where id = '$id'";
        $query = $this->db->query($sql);
        return ['picture' => $img];
    }
    public function getAllBooks($param) {

        // sql statement
        $sql = "SELECT * FROM " . DB_PREFIX . "book";





        // render page data

        // read books with limit of page

        // exec query
        $query = $this->db->query($sql);

        $data = [];

        // Conclusion
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

    public function getAllAuthors($param) {
        $sql = "SELECT * FROM " . DB_PREFIX . "authors";

        // pagination
        // check valid page

        // render page data

        // read books with limit of page

        $query = $this->db->query($sql);

        $data = [];

        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data['authors'][] = [
                        'author'   => $value,
                        'books'    => $this->getBooksAuthor($value['id'])
                    ];
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
        $sql = "SELECT * FROM " . DB_PREFIX . "authors WHERE fullname LIKE '%" . $this->db->escape($param['author']) . "%'";

        // total data find
        $total = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "authors WHERE fullname LIKE '%" . $this->db->escape($param['author']) . "%'");
        
        // pagination 

        // check valid page


        // render page data

        // read books with limit of page

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

    public function searchBooksByTitle($param)
    {
        $like = urldecode( $this->db->escape($param['name']));
        $sql = "SELECT * FROM " . DB_PREFIX . "book WHERE name LIKE '%' '$like' '%'";

        $total = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "book WHERE name LIKE '%" . $this->db->escape($param['name']) . "%'");


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
        $query = $this->db->query("INSERT INTO `rating`(`id`, `createdAt`, `updatedAt`, `bookId`, `authorId`, `rating`) VALUES (null,'$date','$date','$bookId','$authorById','$rating')");
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
    private function getCommentBookById($id) {
        $query  = $this->db->query("SELECT * FROM  comment  where bookId =" . (int) $id) ;
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $result):
                $comment['comment'] = $query->row;
                $comment['author'] = $this->getUser($result['writtenById']);
                array_push($data, $comment);
            endforeach;
        }
        return $data;
    }
    private function getRatingBookById($id) {
        $query  = $this->db->query("SELECT round(AVG(rating),1), COUNT(rating) FROM  rating  where bookId =" . (int) $id) ;

        return $query->row;
    }
    public function getAuthorById($param) {
        $query =  $this->db->query("SELECT * FROM authorsonbook INNER JOIN authors on `authors`.`id` = `authorsonbook`.`authorsId` 
          INNER JOIN book on `book`.`id` = `authorsonbook`.`bookId` WHERE `authorsonbook`.`authorsId` = " . (int) $param['id'] );
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $result):
                $author = $this->getAuthor($result['authorsId']);
                $author['book'] = $this->getBook($result['bookId']);
                array_push($data, $author);
            endforeach;
        }
        return $data;
    }
    public function getBookById($id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "book WHERE id = " . (int) $id . "");
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
        $query = $this->db->query("SELECT email, login, image, status, role FROM " . DB_PREFIX . "usermodel WHERE id = " . (int) $id . "");

        return $query->row;
    }
    private function getBooksAuthor($author) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "authorsonbook WHERE authorsId = " . (int) $author . "");

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
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "book WHERE id = " . (int) $book_id . "");

        return $query->row;
    }

    private function getAuthorsBook($book_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "authorsonbook WHERE bookId = " . (int) $book_id . "");

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
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "authors WHERE id = " . (int) $author_id . "");

        return $query->row;
    }

    private function getCountBooks() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "book");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }

    private function getCountAuthors() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "authors");

        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }
}
