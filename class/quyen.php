<?php
    class Quyen{
        // Connection
        private $conn;
        // Table
        private $db_table = "quyen";
        // Columns
        public $maQuyen;
        public $tenQuyen;
       

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllQuyen(){
            $sqlQuery = "SELECT * FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

    }

?>