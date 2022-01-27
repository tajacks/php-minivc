<?php

    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbName = DB_NAME;
        private $dbChar = DB_CHAR;

        private $conn; //ToDo document
        private $stmt;
        private $err;

        public function __construct() {
            $connectString = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charset=' . $this->dbChar;


            // Disable emulated prepared statements, enable exceptions, and set default fetch mode to associative array.
            $options = array(
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            // Create PDO instance
            try {
                $this->conn = new PDO($connectString, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                $this->err = $e->getMessage();
                error_log($this->err);
                exit('An issue has been encountered.');
            }

        }

        // Prepares a statement for execution
        public function query($sql) {
            $this->stmt = $this->conn->prepare($sql);
        }

        // Bind values to the stored statement. If the type is not provided, attempt to auto derive type. 
        public function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute and return the statement for handling
        public function execute(){
            return $this->stmt->execute(); 
        }

        // Execute and return the results as objects
        public function resultObj(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Execute and return the result as an associative array
        public function resultAssoc() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Execute and return a single result as object
        public function singleObj(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }
        
        // Execute and return a single result as a value
        public function singleValue(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_COLUMN);
        }

        // Return the row count
        public function getRowCount(){
            return $this->stmt->rowCount();
        }
        
        // Retrieve insertion ID
        public function getInsertId() {
            return $this->conn->lastInsertId();
        }
    }
