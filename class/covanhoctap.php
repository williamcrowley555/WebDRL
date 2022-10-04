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
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, maKhoa, matKhauTaiKhoanCoVan FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL THEO MAKHOA 
        public function getAllCVHTTheoMaKhoa($maKhoa)
        {
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, maKhoa, matKhauTaiKhoanCoVan 
                            FROM " . $this->db_table . " WHERE maKhoa = ?";
                                
    
            if (@$_GET['page'] && @$_GET['row_per_page']) {
                $page = $_GET['page'];
                $row_per_page = $_GET['row_per_page'];
    
                $begin = ($page * $row_per_page) - $row_per_page;
    
                $sqlQuery .= " LIMIT " . $begin . "," . $row_per_page . "";
            }
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maKhoa);
            $stmt->execute();
            return $stmt;
        }

        // GET CO VAN HOC TAP THEO MA CVHT
        public function getCVHTTheoMaCVHT($maCVHT, $isEqual = true)
        {
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, maKhoa, matKhauTaiKhoanCoVan FROM " . $this->db_table . " 
                            WHERE maCoVanHocTap" . 
                            ($isEqual ? " = '$maCVHT'" : " LIKE '%$maCVHT%'");
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleCVHT(){
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, maKhoa, matKhauTaiKhoanCoVan FROM ". $this->db_table ."
                        WHERE maCoVanHocTap = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maCoVanHocTap);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maCoVanHocTap = $dataRow['maCoVanHocTap'];
                $this->hoTenCoVan = $dataRow['hoTenCoVan'];
                $this->soDienThoai = $dataRow['soDienThoai'];
                $this->maKhoa = $dataRow['maKhoa'];
                $this->matKhauTaiKhoanCoVan = $dataRow['matKhauTaiKhoanCoVan'];
            }
            
        }

        // CREATE
        public function createCVHT(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maCoVanHocTap = :maCoVanHocTap,
                        hoTenCoVan = :hoTenCoVan, 
                        soDienThoai = :soDienThoai, 
                        maKhoa = :maKhoa, 
                        matKhauTaiKhoanCoVan = :matKhauTaiKhoanCoVan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->hoTenCoVan=htmlspecialchars(strip_tags($this->hoTenCoVan));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->matKhauTaiKhoanCoVan=htmlspecialchars(strip_tags($this->matKhauTaiKhoanCoVan));
        
            // bind data
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":hoTenCoVan", $this->hoTenCoVan);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
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
                        maKhoa = :maKhoa, 
                        matKhauTaiKhoanCoVan = :matKhauTaiKhoanCoVan
                    WHERE 
                        maCoVanHocTap = :maCoVanHocTap";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->hoTenCoVan=htmlspecialchars(strip_tags($this->hoTenCoVan));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->matKhauTaiKhoanCoVan=htmlspecialchars(strip_tags($this->matKhauTaiKhoanCoVan));
        
            // bind data
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":hoTenCoVan", $this->hoTenCoVan);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":matKhauTaiKhoanCoVan", $this->matKhauTaiKhoanCoVan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        // UPDATE
        public function updateCVHT_KhongMatKhau(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        hoTenCoVan = :hoTenCoVan, 
                        soDienThoai = :soDienThoai,
                        maKhoa = :maKhoa
                    WHERE 
                        maCoVanHocTap = :maCoVanHocTap";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->hoTenCoVan=htmlspecialchars(strip_tags($this->hoTenCoVan));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
       
            // bind data
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":hoTenCoVan", $this->hoTenCoVan);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
   
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

        // check login
        public function check_login(){
            $sqlQuery = "SELECT maCoVanHocTap, hoTenCoVan, soDienThoai, maKhoa FROM ". $this->db_table .
                            "WHERE maCoVanHocTap = ? AND matKhauTaiKhoanCoVan = ?  LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maCoVanHocTap);
            $stmt->bindParam(2, $this->matKhauTaiKhoanCoVan);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maCoVanHocTap = $dataRow['maCoVanHocTap'];
                $this->hoTenCoVan = $dataRow['hoTenCoVan'];
                $this->soDienThoai = $dataRow['soDienThoai'];
                $this->maKhoa = $dataRow['maKhoa'];
                return true;

            }
            return false;
        }

    }

?>