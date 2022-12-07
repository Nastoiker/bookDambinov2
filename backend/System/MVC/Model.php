<?php


namespace MVC;


class Model {


    public $db;

    public function __construct() {
        $this->db = new \Database\DatabaseAdapter(
            'PDO',
            DATABASE['Host'],
            DATABASE['User'],
            DATABASE['Pass'],
            DATABASE['Name'],
            DATABASE['Port']    
        );
    }
}
