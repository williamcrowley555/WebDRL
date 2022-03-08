<?php
    class Tieuchicap3{
        // Connection
        private $conn;
        // Table
        private $db_table = "tieuchicap3";
        // Columns
        public $matc3;
        public $noidung;
        public $diem;
        public $matc2;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllTC3(){
            $sqlQuery = "SELECT matc3, noidung, diem, matc2 FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleTC3(){
            $sqlQuery = "SELECT matc3, noidung, diem, matc2 FROM ". $this->db_table ."
                        WHERE matc3 = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->matc3);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->matc3 = $dataRow['matc3'];
                $this->noidung = $dataRow['noidung'];
                $this->diem = $dataRow['diem'];
                $this->matc2 = $dataRow['matc2'];
            }
            
        }

        // CREATE
        public function createTC3(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        noidung = :noidung, 
                        diem = :diem, 
                        matc2 = :matc2";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diem=htmlspecialchars(strip_tags($this->diem));
            $this->matc2=htmlspecialchars(strip_tags($this->matc2));
        
            // bind data
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diem", $this->diem);
            $stmt->bindParam(":matc2", $this->matc2);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateTC3(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        noidung = :noidung, 
                        diem = :diem, 
                        matc2 = :matc2
                    WHERE 
                        matc3 = :matc3";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->matc3=htmlspecialchars(strip_tags($this->matc3));
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diem=htmlspecialchars(strip_tags($this->diem));
            $this->matc2=htmlspecialchars(strip_tags($this->matc2));
        
            // bind data
            $stmt->bindParam(":matc3", $this->matc3);
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diem", $this->diem);
            $stmt->bindParam(":matc2", $this->matc2);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteTC3(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE matc3 = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->matc3=htmlspecialchars(strip_tags($this->matc3));
        
            $stmt->bindParam(1, $this->matc3);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>