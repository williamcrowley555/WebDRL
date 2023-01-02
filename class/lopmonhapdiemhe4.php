<?php
    class LopMoNhapDiemHe4{
        // Connection
        private $conn;
        // Table
        private $db_table = "lopmonhapdiemhe4";
        // Columns
        public $maLop;
        public $maHocKyMo;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL THEO MA LOP
        public function getAllLopTheoMaLop($maLop) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maLop = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maLop);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL THEO MA LOP VA MA HOC KY MO
        public function getAllLopTheoMaLopVaMaHocKyMo($maLop, $maHocKyMo) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maLop = ? AND maHocKyMo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maLop);
            $stmt->bindParam(2, $maHocKyMo);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createLopMoNhapDiemHe4(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maLop = :maLop,
                        maHocKyMo = :maHocKyMo";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maLop=htmlspecialchars(strip_tags($this->maLop));
            $this->maHocKyMo=htmlspecialchars(strip_tags($this->maHocKyMo));
        
            // bind data
            $stmt->bindParam(":maLop", $this->maLop);
            $stmt->bindParam(":maHocKyMo", $this->maHocKyMo);
        
            if($stmt->execute()){
            return true;
            }
            return false;
        }

        // DELETE
        function deleteLopMoNhapDiemHe4(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maLop = ? AND maHocKyMo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maLop=htmlspecialchars(strip_tags($this->maLop));
            $this->maHocKyMo=htmlspecialchars(strip_tags($this->maHocKyMo));
        
            $stmt->bindParam(1, $this->maLop);
            $stmt->bindParam(2, $this->maHocKyMo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }

    

?>