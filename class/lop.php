<?php
    class Lop{
        // Connection
        private $conn;
        // Table
        private $db_table = "lop";
        // Columns
        public $maLop;
        public $tenLop;
        public $maKhoa;
        public $maCoVanHocTap;
        public $maKhoaHoc;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllLop(){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        //GET ALL LOP THEO MA CO VAN
        public function getAllLopTheoMaCoVan($maCoVanHocTap){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . " 
                        WHERE maCoVanHocTap = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maCoVanHocTap);
            $stmt->execute();
            return $stmt;
        }
        
        //GET ALL LOP THEO MA KHOA
        public function getAllLopTheoMaKhoa($maKhoa){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . " 
                        WHERE maKhoa = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maKhoa);
            $stmt->execute();
            return $stmt;
        }
        
        //GET ALL LOP THEO MA KHOA & MA KHOA HOC
        public function getAllLopTheoMaKhoaVaMaKhoaHoc($maKhoa, $maKhoaHoc){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . " 
                        WHERE maKhoa = ? AND maKhoaHoc = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maKhoa);
            $stmt->bindParam(2, $maKhoaHoc);
            $stmt->execute();
            return $stmt;
        }

        // GET LOP THEO MA LOP
        public function getLopTheoMaLop($maLop, $isEqual = true)
        {
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . " 
                            WHERE UPPER(maLop)" . 
                            ($isEqual ? " = UPPER('$maLop')" : " LIKE UPPER('%$maLop%')");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // READ single
        public function getSingleLop(){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM ". $this->db_table .
                            ($this->maLop ? " WHERE UPPER(maLop) = UPPER('$this->maLop')" : "") . 
                            (($this->maKhoa && $this->maKhoaHoc) ? 
                                (" WHERE UPPER(maLop) LIKE UPPER('%$this->maKhoa" . "1" . substr($this->maKhoaHoc, 1) . "%') ORDER BY maLop DESC") 
                                : 
                                "") .
                            " LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maLop = $dataRow['maLop'];
                $this->tenLop = $dataRow['tenLop'];
                $this->maKhoa = $dataRow['maKhoa'];
                $this->maCoVanHocTap = $dataRow['maCoVanHocTap'];
                $this->maKhoaHoc = $dataRow['maKhoaHoc'];
            }
        }
        
        // READ single details
        public function getSingleLopDetails(){
            $sqlQuery = "SELECT * 
                            FROM lop LEFT JOIN khoa ON lop.maKhoa = khoa.maKhoa
                                LEFT JOIN covanhoctap ON lop.maCoVanHocTap = covanhoctap.maCoVanHocTap
                            WHERE lop.maLop = ? 
                            LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maLop);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maLop = $dataRow['maLop'];
                $this->tenLop = $dataRow['tenLop'];
                $this->maKhoa = $dataRow['maKhoa'];
                $this->tenKhoa = $dataRow['tenKhoa'];
                $this->maCoVanHocTap = $dataRow['maCoVanHocTap'];
                $this->hoTenCoVan = $dataRow['hoTenCoVan'];
                $this->soDienThoaiCoVan = $dataRow['soDienThoai'];
                $this->maKhoaHoc = $dataRow['maKhoaHoc'];
            }
        }

        // CREATE
        public function createLop(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maLop = :maLop,
                        tenLop = :tenLop, 
                        maKhoa = :maKhoa, 
                        maCoVanHocTap = :maCoVanHocTap,
                        maKhoaHoc = :maKhoaHoc";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maLop=htmlspecialchars(strip_tags($this->maLop));
            $this->tenLop=htmlspecialchars(strip_tags($this->tenLop));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->maKhoaHoc=htmlspecialchars(strip_tags($this->maKhoaHoc));
        
            // bind data
            $stmt->bindParam(":maLop", $this->maLop);
            $stmt->bindParam(":tenLop", $this->tenLop);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":maKhoaHoc", $this->maKhoaHoc);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateLop(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        tenLop = :tenLop, 
                        maKhoa = :maKhoa, 
                        maCoVanHocTap = :maCoVanHocTap,
                        maKhoaHoc = :maKhoaHoc
                    WHERE 
                        maLop = :maLop";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maLop=htmlspecialchars(strip_tags($this->maLop));
            $this->tenLop=htmlspecialchars(strip_tags($this->tenLop));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->maCoVanHocTap=htmlspecialchars(strip_tags($this->maCoVanHocTap));
            $this->maKhoaHoc=htmlspecialchars(strip_tags($this->maKhoaHoc));
        
            // bind data
            $stmt->bindParam(":maLop", $this->maLop);
            $stmt->bindParam(":tenLop", $this->tenLop);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":maCoVanHocTap", $this->maCoVanHocTap);
            $stmt->bindParam(":maKhoaHoc", $this->maKhoaHoc);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteLop(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maLop = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maLop=htmlspecialchars(strip_tags($this->maLop));
        
            $stmt->bindParam(1, $this->maLop);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>