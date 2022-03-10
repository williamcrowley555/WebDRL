<?php
    class KhoaHoc{
        // Connection
        private $conn;
        // Table
        private $db_table = "khoahoc";
        // Columns
        public $maKhoaHoc;
        public $namBatDau;
        public $namKetThuc;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllKhoaHoc(){
            $sqlQuery = "SELECT maKhoaHoc, namBatDau, namKetThuc FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleKhoaHoc(){
            $sqlQuery = "SELECT maKhoaHoc, namBatDau, namKetThuc FROM ". $this->db_table ."
                        WHERE maKhoaHoc = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maKhoaHoc);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maKhoaHoc = $dataRow['maKhoaHoc'];
                $this->namBatDau = $dataRow['namBatDau'];
                $this->namKetThuc = $dataRow['namKetThuc'];
            }
            
        }

        // CREATE
        public function createKhoaHoc(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        namBatDau = :namBatDau, 
                        namKetThuc = :namKetThuc";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->namBatDau=htmlspecialchars(strip_tags($this->namBatDau));
            $this->namKetThuc=htmlspecialchars(strip_tags($this->namKetThuc));
        
            // bind data
            $stmt->bindParam(":namBatDau", $this->namBatDau);
            $stmt->bindParam(":namKetThuc", $this->namKetThuc);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateKhoaHoc(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        namBatDau = :namBatDau, 
                        namKetThuc = :namKetThuc, 
                    WHERE 
                        maKhoaHoc = :maKhoaHoc";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhoaHoc=htmlspecialchars(strip_tags($this->maKhoaHoc));
            $this->namBatDau=htmlspecialchars(strip_tags($this->namBatDau));
            $this->namKetThuc=htmlspecialchars(strip_tags($this->namKetThuc));
        
            // bind data
            $stmt->bindParam(":maKhoaHoc", $this->maKhoaHoc);
            $stmt->bindParam(":namBatDau", $this->namBatDau);
            $stmt->bindParam(":namKetThuc", $this->namKetThuc);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteKhoaHoc(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maKhoaHoc = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maKhoaHoc=htmlspecialchars(strip_tags($this->maKhoaHoc));
        
            $stmt->bindParam(1, $this->maKhoaHoc);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>