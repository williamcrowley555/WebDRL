<?php
    class ChucNang_Quyen{
        // Connection
        private $conn;
        // Table
        private $db_table = "chucnang_quyen";
        // Columns
        public $maChucNang;
        public $maQuyen;
        public $ghiChu;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL THEO MA CHUC NANG
        public function getAllTheoMaChucNang($maChucNang){
            $sqlQuery = "SELECT * FROM " . $this->db_table . 
                        " WHERE maChucNang = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maChucNang);
            $stmt->execute();

            return $stmt;
        }

        // GET ALL DETAISL THEO MA CHUC NANG
        public function getAllDetailsTheoMaChucNang($maChucNang) {
            $sqlQuery = "SELECT chucnang_quyen.*, quyen.* 
                        FROM chucnang_quyen, quyen
                        WHERE chucnang_quyen.maQuyen = quyen.maQuyen 
                            AND chucnang_quyen.maChucNang = ?";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maChucNang);
            $stmt->execute();
            
            return $stmt;
        }

        // GET SINGLE DETAILS THEO MA CHUC NANG VA MA QUYEN
        public function getSingleDetailsTheoMaChucNangVaMaQuyen($maChucNang, $maQuyen) {
            $sqlQuery = "SELECT chucnang_quyen.*, quyen.* 
                        FROM chucnang_quyen, quyen
                        WHERE chucnang_quyen.maQuyen = quyen.maQuyen 
                            AND chucnang_quyen.maChucNang = ?
                            AND chucnang_quyen.maQuyen = ?";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maChucNang);
            $stmt->bindParam(2, $maQuyen);
            $stmt->execute();
            
            return $stmt;
        }

        // CREATE
        public function createChucNang_Quyen(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maChucNang = :maChucNang,
                        maQuyen = :maQuyen, 
                        ghiChu = :ghiChu";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
            $this->maQuyen=htmlspecialchars(strip_tags($this->maQuyen));
            $this->ghiChu=htmlspecialchars(strip_tags($this->ghiChu));
        
            // bind data
            $stmt->bindParam(":maChucNang", $this->maChucNang);
            $stmt->bindParam(":maQuyen", $this->maQuyen);
            $stmt->bindParam(":ghiChu", $this->ghiChu);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteChucNang_QuyenTheoMaChucNang($maChucNang){
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