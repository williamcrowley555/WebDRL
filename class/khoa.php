<?php
    class Khoa{
        // Connection
        private $conn;
        // Table
        private $db_table = "khoa";
        // Columns
        public $maKhoa;
        public $tenKhoa;
        public $taiKhoanKhoa;
        public $matKhauKhoa;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllKhoa(){
            $sqlQuery = "SELECT maKhoa, tenKhoa, taiKhoanKhoa, matKhauKhoa FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL THEO MAKHOA 
        public function getKhoaTheoMaKhoa($maKhoa, $isEqual = true){
            $sqlQuery = "SELECT maKhoa, tenKhoa, taiKhoanKhoa, matKhauKhoa FROM " . $this->db_table . " 
                            WHERE UPPER(maKhoa)" . 
                            ($isEqual ? " = UPPER('$maKhoa')" : " LIKE UPPER('%$maKhoa%')");
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleKhoa(){
            $sqlQuery = "SELECT maKhoa, tenKhoa, taiKhoanKhoa, matKhauKhoa FROM ". $this->db_table ."
                        WHERE maKhoa = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maKhoa);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maKhoa = $dataRow['maKhoa'];
                $this->tenKhoa = $dataRow['tenKhoa'];
                $this->taiKhoanKhoa = $dataRow['taiKhoanKhoa'];
                $this->matKhauKhoa = $dataRow['matKhauKhoa'];
            }
            
        }
        // Check login
        public function check_login(){
            $sqlQuery = "SELECT maKhoa, tenKhoa, taiKhoanKhoa, matKhauKhoa FROM ". $this->db_table ."
                        WHERE taiKhoanKhoa = ? AND matKhauKhoa = ?  LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->taiKhoanKhoa);
            $stmt->bindParam(2, $this->matKhauKhoa);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maKhoa = $dataRow['maKhoa'];
                $this->tenKhoa = $dataRow['tenKhoa'];
                $this->taiKhoanKhoa = $dataRow['taiKhoanKhoa'];
                $this->matKhauKhoa = $dataRow['matKhauKhoa'];
                return true;

            }
            return false;  
        }

        // CREATE
        public function createKhoa(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maKhoa = :maKhoa,
                        tenKhoa = :tenKhoa, 
                        taiKhoanKhoa = :taiKhoanKhoa, 
                        matKhauKhoa = :matKhauKhoa";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenKhoa=htmlspecialchars(strip_tags($this->tenKhoa));
            $this->taiKhoanKhoa=htmlspecialchars(strip_tags($this->taiKhoanKhoa));
            $this->matKhauKhoa=htmlspecialchars(strip_tags($this->matKhauKhoa));
        
            // bind data
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenKhoa", $this->tenKhoa);
            $stmt->bindParam(":taiKhoanKhoa", $this->taiKhoanKhoa);
            $stmt->bindParam(":matKhauKhoa", $this->matKhauKhoa);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateKhoa(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        tenKhoa = :tenKhoa, 
                        taiKhoanKhoa = :taiKhoanKhoa, 
                        matKhauKhoa = :matKhauKhoa
                    WHERE 
                        maKhoa = :maKhoa";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenKhoa=htmlspecialchars(strip_tags($this->tenKhoa));
            $this->taiKhoanKhoa=htmlspecialchars(strip_tags($this->taiKhoanKhoa));
            $this->matKhauKhoa=htmlspecialchars(strip_tags($this->matKhauKhoa));
        
            // bind data
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenKhoa", $this->tenKhoa);
            $stmt->bindParam(":taiKhoanKhoa", $this->taiKhoanKhoa);
            $stmt->bindParam(":matKhauKhoa", $this->matKhauKhoa);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // UPDATE
        public function updateKhoa_KhongMatKhau(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        tenKhoa = :tenKhoa
                    WHERE 
                        maKhoa = :maKhoa";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenKhoa=htmlspecialchars(strip_tags($this->tenKhoa));
 
            // bind data
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenKhoa", $this->tenKhoa);
         
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteKhoa(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maKhoa = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
        
            $stmt->bindParam(1, $this->maKhoa);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>