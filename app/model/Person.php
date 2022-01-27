<?php

    class Person {
        private $db;

        // Create a new Database on Construction
        public function __construct() {
            $this->db = new Database();
        }

        public function getPeople() {
            $this->db->query("SELECT * FROM Persons");

            return $this->db->resultAssoc(); 
        }
    }