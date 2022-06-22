<?php
    class Tieuchicap1{
        // Connection
        private $conn;
        // Table
        private $db_table = "tieuchicap1";
        // Columns
        public $matc1;
        public $noidung;
        public $diemtoida;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllTC1(){
            $sqlQuery = "SELECT matc1, noidung, diemtoida FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleTC1(){
            $sqlQuery = "SELECT matc1, noidung, diemtoida FROM ". $this->db_table ."
                        WHERE matc1 = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->matc1);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->matc1 = $dataRow['matc1'];
                $this->noidung = $dataRow['noidung'];
                $this->diemtoida = $dataRow['diemtoida'];
            }
            
        }

        // CREATE
        public function createTC1(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        noidung = :noidung, 
                        diemtoida = :diemtoida";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diemtoida=htmlspecialchars(strip_tags($this->diemtoida));
        
            // bind data
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diemtoida", $this->diemtoida);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateTC1(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        noidung = :noidung, 
                        diemtoida = :diemtoida
                    WHERE 
                        matc1 = :matc1";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->matc1=htmlspecialchars(strip_tags($this->matc1));
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diemtoida=htmlspecialchars(strip_tags($this->diemtoida));
        
            // bind data
            $stmt->bindParam(":matc1", $this->matc1);
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diemtoida", $this->diemtoida);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteTC1(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE matc1 = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->matc1=htmlspecialchars(strip_tags($this->matc1));
        
            $stmt->bindParam(1, $this->matc1);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>