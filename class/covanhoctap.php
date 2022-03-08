<?php
    class CVHT{
        // Connection
        private $conn;
        // Table
        private $db_table = "covanhoctap";
        // Columns
        public $maCoVanHocTap;
        public $hoTenCoVan;
        public $soDienThoai;
        public $matKhauTaiKhoanCoVan;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllCVHT(){
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, matKhauTaiKhoanCoVan FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleCVHT(){
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, matKhauTaiKhoanCoVan FROM ". $this->db_table ."
                        WHERE maCoVanHocTap = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maCoVanHocTap);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maCoVanHocTap = $dataRow['maCoVanHocTap'];
                $this->hoTenCoVan = $dataRow['hoTenCoVan'];
                $this->soDienThoai = $dataRow['soDienThoai'];
                $this->matKhauTaiKhoanCoVan = $dataRow['matKhauTaiKhoanCoVan'];
            }
            
        }

        // CREATE
        public function createCVHT(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        hoTenCoVan = :hoTenCoVan, 
                        soDienThoai = :soDienThoai, 
                        matKhauTaiKhoanCoVan = :matKhauTaiKhoanCoVan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->hoTenCoVan=htmlspecialchars(strip_tags($this->hoTenCoVan));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->matKhauTaiKhoanCoVan=htmlspecialchars(strip_tags($this->matKhauTaiKhoanCoVan));
        
            // bind data
            $stmt->bindParam(":hoTenCoVan", $this->hoTenCoVan);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":matKhauTaiKhoanCoVan", $this->matKhauTaiKhoanCoVan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateCVHT(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        hoTenCoVan = :hoTenCoVan, 
                        soDienThoai = :soDienThoai, 
                        matKhauTaiKhoanCoVan = :matKhauTaiKhoanCoVan
                    WHERE 
                        maCoVanHocTap = :maCoVanHocTap";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->hoTenCoVan=htmlspecialchars(strip_tags($this->hoTenCoVan));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->matKhauTaiKhoanCoVan=htmlspecialchars(strip_tags($this->matKhauTaiKhoanCoVan));
        
            // bind data
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":hoTenCoVan", $this->hoTenCoVan);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":matKhauTaiKhoanCoVan", $this->matKhauTaiKhoanCoVan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCVHT(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maCoVanHocTap = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
        
            $stmt->bindParam(1, $this->maCoVanHocTap);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>