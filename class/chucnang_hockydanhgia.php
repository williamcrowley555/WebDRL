<?php
    class ChucNang_HocKyDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "chucnang_hockydanhgia";
        // Columns
        public $maChucNang;
        public $maHocKyDanhGia;
        public $ghiChu;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL THEO MA CHUC NANG
        public function getAllTheoMaChucNang($maChucNang) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . 
                        " WHERE maChucNang = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maChucNang);
            $stmt->execute();

            return $stmt;
        }

        // GET ALL DETAISL THEO MA CHUC NANG
        public function getAllDetailsTheoMaChucNang($maChucNang) {
            $sqlQuery = "SELECT chucnang_hockydanhgia.*, hockydanhgia.* 
                        FROM chucnang_hockydanhgia, hockydanhgia
                        WHERE chucnang_hockydanhgia.maHocKyDanhGia = hockydanhgia.maHocKyDanhGia 
                            AND chucnang_hockydanhgia.maChucNang = ?";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maChucNang);
            $stmt->execute();
            
            return $stmt;
        }

        // CREATE
        public function createChucNang_HocKyDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maChucNang = :maChucNang,
                        maHocKyDanhGia = :maHocKyDanhGia, 
                        ghiChu = :ghiChu";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->ghiChu=htmlspecialchars(strip_tags($this->ghiChu));
        
            // bind data
            $stmt->bindParam(":maChucNang", $this->maChucNang);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":ghiChu", $this->ghiChu);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteChucNang_HocKyDanhGiaTheoMaChucNang($maChucNang){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maChucNang = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maChucNang=htmlspecialchars(strip_tags($maChucNang));
        
            $stmt->bindParam(1, $maChucNang);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }

?>