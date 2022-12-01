<?php
use MVC\Model;
class ModelsAdmin extends Model {
    public function getAllUser() {
        $query = $this->db->query("SELECT * FROM usermodel");
        return $query->rows;
    }
    public function setPhoto($img, $id) {
        $sql = "UPDATE book SET img = '$img' where id = '$id'";
        $query = $this->db->query($sql);
        return ['picture' => $img];
    }
    public function createBook($data) {
        $name = $data['name'];
        $img = $data['image'];
        $Authors = $data['Authors'];
        $Genres = $data['Genres'];
        $releseYear = $data['releseYear'];
        $description = $data['description'];
        $check_exist = $this->db->query("select * from `book`  where name=" . $name);
        if($check_exist->row) {
            $id = $check_exist->row['id'];
            $query = $this->db->query("UPDATE `book` SET `id`='$id',`name`='$name',`releseYear`='$releseYear',`description`='$description',`img`='$img' WHERE name=" . $name);
            foreach($Authors->rows as $key => $value):
                $this->db->query("UPDATE `authorsonbook` SET `authorsId`='$value', WHERE `bookId`=" . (int) $id);
            endforeach;
            foreach($Genres->rows as $key => $value):
                $this->db->query("UPDATE `genresonbook` SET `genresId`= (int) $value, WHERE `bookId`=" . (int) $id);
            endforeach;
        } else {
            $sql = "INSERT INTO `book`(`id`, `name`, `releseYear`, `description`, `img`) VALUES (null,'$name','$releseYear','$description','$img')";
            $query = $this->db->query($sql);
            $check_exist = $this->db->query("select * from `book`  where name=" . $name);
            $id = $check_exist->row['id'];
            foreach($Authors->rows as $key => $value):
                $this->db->query("INSERT INTO `authorsonbook`(`authorsId`, `bookId`) VALUES (`$value`, `$id`)");
            endforeach;
            foreach($Genres->rows as $key => $value):
                $this->db->query("INSERT INTO `genresonbook`(`genresId`, `bookId`) VALUES (`$value` , `$id`)" );
            endforeach;
            $this->db->query("UPDATE `authorsonbook` SET `authorsId`='$value', WHERE `bookId`=" . (int) $id);
            return 'created';

        }
    }
}