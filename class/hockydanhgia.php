<?php
    class HocKyDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "hockydanhgia";
        // Columns
        public $maHocKyDanhGia;
        public $hocKyXet;
        public $namHocXet;
       

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllHocKyDanhGia(){
            $sqlQuery = "SELECT maHocKyDanhGia , hocKyXet, namHocXet FROM " . $this->db_table . 
                        " ORDER BY namHocXet ASC, hocKyXet ASC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleHocKyDanhGia(){
            $sqlQuery = "SELECT maHocKyDanhGia, hocKyXet, namHocXet FROM ". $this->db_table ."
                        WHERE maHocKyDanhGia  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maHocKyDanhGia );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maHocKyDanhGia  = $dataRow['maHocKyDanhGia'];
                $this->hocKyXet = $dataRow['hocKyXet'];
                $this->namHocXet = $dataRow['namHocXet'];
            }
            
        }

        // READ single 2
        public function getSingleHocKyDanhGia_theoHocKyNamHoc(){
            $sqlQuery = "SELECT maHocKyDanhGia, hocKyXet, namHocXet FROM ". $this->db_table ."
                        WHERE hocKyXet = ? AND namHocXet = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->hocKyXet );
            $stmt->bindParam(2, $this->namHocXet );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maHocKyDanhGia  = $dataRow['maHocKyDanhGia'];
                $this->hocKyXet = $dataRow['hocKyXet'];
                $this->namHocXet = $dataRow['namHocXet'];
            }
        }

        // GET HOC KY DANH GIA THEO MA HOC KY DANH GIA
        public function getHocKyDanhGiaTheoMaHocKyDanhGia($maHocKyDanhGia, $isEqual = true)
        {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE maHocKyDanhGia" . 
                            ($isEqual ? " = '$maHocKyDanhGia'" : " LIKE '%$maHocKyDanhGia%'");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getHocKyVaNamHoc($hocKyXet, $namHocXet) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "
                            WHERE hocKyXet = '$hocKyXet'
                            AND namHocXet = '$namHocXet'";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createHocKyDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maHocKyDanhGia = :maHocKyDanhGia,
                        hocKyXet = :hocKyXet, 
                        namHocXet = :namHocXet";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->hocKyXet=htmlspecialchars(strip_tags($this->hocKyXet));
            $this->namHocXet=htmlspecialchars(strip_tags($this->namHocXet));
            
        
            // bind data
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":hocKyXet", $this->hocKyXet);
            $stmt->bindParam(":namHocXet", $this->namHocXet);
      
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateHocKyDanhGia(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        hocKyXet = :hocKyXet, 
                        namHocXet = :namHocXet
                    WHERE 
                        maHocKyDanhGia  = :maHocKyDanhGia ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHocKyDanhGia =htmlspecialchars(strip_tags($this->maHocKyDanhGia ));
            $this->hocKyXet=htmlspecialchars(strip_tags($this->hocKyXet));
            $this->namHocXet=htmlspecialchars(strip_tags($this->namHocXet));
           
            // bind data
            $stmt->bindParam(":maHocKyDanhGia ", $this->maHocKyDanhGia );
            $stmt->bindParam(":hocKyXet", $this->hocKyXet);
            $stmt->bindParam(":namHocXet", $this->namHocXet);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteHocKyDanhGia(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maHocKyDanhGia = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maHocKyDanhGia =htmlspecialchars(strip_tags($this->maHocKyDanhGia ));
        
            $stmt->bindParam(1, $this->maHocKyDanhGia );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>