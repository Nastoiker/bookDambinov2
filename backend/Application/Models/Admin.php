<?php
use MVC\Model;
class ModelsAdmin extends Model
{
    public function getAllUser()
    {
        $query = $this->db->query("SELECT * FROM usermodel");
        return $query->rows;
    }

    public function setPhoto($img, $id)
    {
        $sql = "UPDATE book SET img = '$img' where id = '$id'";
        $query = $this->db->query($sql);
        return ['picture' => $img];
    }

    public function deleteBook($param)
    {
        $id = $param['id'];
        $sql = "DELETE FROM book where id = '$id'";
        $exist = $this->db->query("SELECT image FROM book WHERE id='$id'");
        unlink(UPLOAD . '/images/' . $exist );
        $res = $this->db->query($sql);
        return 'delete';
    }

    public function createNewAuthor($param)
    {

        $firstName = $param['firstName'];
        $lastname = $param['lastName'];
        $image = $param['image'];
        $sql = "INSERT INTO `authors`(`id`, `firstName`, `lastname`, `avatar_author`) VALUES (null,'$firstName','$lastname', '$image')";
        $this->db->query($sql);
        return 'created';
    }

    public function createNewGenre($param)
    {
        $name = $param['name'];
        $image = $param['image'];
        $sql = "INSERT INTO `genres`(`id`, `name`, `img`) VALUES (null,'$name', '$image')";
        $this->db->query($sql);
        return 'created';
    }
    public function getAllComments() {
        $res = $this->db->query("SELECT `id`, `createdAt`, `comment`, `writtenById`, `bookId` FROM `comment` ");
        return  $res->rows;
    }
    public function deleteComment($id) {
        $this->db->query("DELETE FROM `comment` WHERE `id` = '$id'");
        return 'deleted';
    }
    public function createBook($data)
    {
        $name = $data['name'];
        $img = $data['image'];
        $Authors = $data['Authors'];
        $Genres = $data['Genres'];
        $releseYear = $data['releseYear'];
        $description = $data['description'];
        foreach ($Authors as $key => $value):
            $value = str_replace(']', '', $value);
            $value = str_replace('[', '', $value);
            $Authors[$key] = (int)$value;
        endforeach;
        foreach ($Genres as $key => $value):
            $value = str_replace(']', '', $value);
            $value = str_replace('[', '', $value);
            $Genres[$key] = (int)$value;
        endforeach;
        $check_exist = $this->db->query("select * from `book`  where name='$name'");
        if ($check_exist->num_rows) {
            $id = (int)$check_exist->row['id'];
            $query = $this->db->query("UPDATE `book` SET  `name`='$name',`releseYear`='$releseYear',`description`='$description',`img`='$img' WHERE name='$name'");
                foreach ($Authors as $key => $value):
                    $sqlcheckAuthorExist = $this->db->query("SELECT * FROM `authorsonbook` WHERE `authorsId`='$value' and `bookId`=" . $id);
                    if(!$sqlcheckAuthorExist->num_rows){
                        $this->db->query("UPDATE `authorsonbook` SET `authorsId`='$value' WHERE `bookId`=" . $id);
                    }
                endforeach;
                foreach ($Genres as $key => $value):
                    $sqlcheckGenrerExist = $this->db->query("SELECT * FROM `genresonbook` WHERE `genresId`= '$value' and `bookId`=" . $id);
                    if(!$sqlcheckGenrerExist->num_rows){
                        $this->db->query("UPDATE `genresonbook` SET `genresId`= '$value' WHERE `bookId`=" . $id);
                    }
                endforeach;
            return 'created';
        } else {
            $sql = "INSERT INTO `book`(`id`, `name`, `releseYear`, `description`, `img`) VALUES (null,'$name','$releseYear','$description','$img')";
            $query = $this->db->query($sql);
            $id = $this->db->query("select id from book  where name= '$name'");
            $id = (int)$id->row['id'];
            foreach ($Authors as $key => $value):
                $this->db->query("INSERT INTO `authorsonbook`(`authorsId`, `bookId`) VALUES (" . (int)$value . "," . $id . ")");
            endforeach;
            foreach ($Genres as $key => $value):
                $this->db->query("INSERT INTO `genresonbook`(`genresId`, `bookId`) VALUES ($value , $id)");
            endforeach;
            return 'created';
        }
    }
}