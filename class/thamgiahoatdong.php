<?php
    class ThamGiaHoatDong{
        // Connection
        private $conn;
        // Table
        private $db_table = "thamgiahoatdong";
        // Columns
        public $maThamGiaHoatDong;
        public $maHoatDong;
        public $maSinhVienThamGia;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllThamGiaHoatDong(){
            $sqlQuery = "SELECT maThamGiaHoatDong, maHoatDong, maSinhVienThamGia FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleThamGiaHoatDong(){
            $sqlQuery = "SELECT maThamGiaHoatDong, maHoatDong, maSinhVienThamGia FROM ". $this->db_table ."
                        WHERE maThamGiaHoatDong = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maThamGiaHoatDong);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maThamGiaHoatDong = $dataRow['maThamGiaHoatDong'];
                $this->maHoatDong = $dataRow['maHoatDong'];
                $this->maSinhVienThamGia = $dataRow['maSinhVienThamGia'];
            }
            
        }

        // READ single
        public function getSingleThamGiaHoatDong_MaHoatDongVaMaSinhVien(){
            $sqlQuery = "SELECT maThamGiaHoatDong, maHoatDong, maSinhVienThamGia FROM ". $this->db_table ."
                        WHERE maHoatDong = ? AND maSinhVienThamGia = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maHoatDong);
            $stmt->bindParam(2, $this->maSinhVienThamGia);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maThamGiaHoatDong = $dataRow['maThamGiaHoatDong'];
                $this->maHoatDong = $dataRow['maHoatDong'];
                $this->maSinhVienThamGia = $dataRow['maSinhVienThamGia'];
            }
            
        }

        // CREATE
        public function createThamGiaHoatDong(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maHoatDong = :maHoatDong, 
                        maSinhVienThamGia = :maSinhVienThamGia";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHoatDong=htmlspecialchars(strip_tags($this->maHoatDong));
            $this->maSinhVienThamGia=htmlspecialchars(strip_tags($this->maSinhVienThamGia));
        
            // bind data
            $stmt->bindParam(":maHoatDong", $this->maHoatDong);
            $stmt->bindParam(":maSinhVienThamGia", $this->maSinhVienThamGia);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateThamGiaHoatDong(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        maHoatDong = :maHoatDong, 
                        maSinhVienThamGia = :maSinhVienThamGia, 
                    WHERE 
                        maThamGiaHoatDong = :maThamGiaHoatDong";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maThamGiaHoatDong=htmlspecialchars(strip_tags($this->maThamGiaHoatDong));
            $this->maHoatDong=htmlspecialchars(strip_tags($this->maHoatDong));
            $this->maSinhVienThamGia=htmlspecialchars(strip_tags($this->maSinhVienThamGia));
        
            // bind data
            $stmt->bindParam(":maThamGiaHoatDong", $this->maThamGiaHoatDong);
            $stmt->bindParam(":maHoatDong", $this->maHoatDong);
            $stmt->bindParam(":maSinhVienThamGia", $this->maSinhVienThamGia);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteThamGiaHoatDong(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maThamGiaHoatDong = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maThamGiaHoatDong=htmlspecialchars(strip_tags($this->maThamGiaHoatDong));
        
            $stmt->bindParam(1, $this->maThamGiaHoatDong);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>