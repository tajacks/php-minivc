<?php

    class Post {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getPeople() {

            $this->db->query("SELECT * FROM persons");

            return $this->db->resultSet(); // return the result from the above query to wherever it is called from the controller.
        }
    }