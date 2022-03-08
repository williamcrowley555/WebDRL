<?php
    class HocKyDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "hockydanhgia";
        // Columns
        public $hockydanhgia ;
        public $hocKyXet;
        public $namHocXet;
        public $maSinhVien;
        public $coVanDuyet;
        public $khoaDuyet;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllHocKyDanhGia(){
            $sqlQuery = "SELECT hockydanhgia , hocKyXet, namHocXet, maSinhVien, coVanDuyet, khoaDuyet, diemTrungBinhChungHKXet FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleHocKyDanhGia(){
            $sqlQuery = "SELECT hockydanhgia , hocKyXet, namHocXet, maSinhVien, coVanDuyet, khoaDuyet, diemTrungBinhChungHKXet FROM ". $this->db_table ."
                        WHERE hockydanhgia  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->hockydanhgia );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->hockydanhgia  = $dataRow['hockydanhgia '];
                $this->hocKyXet = $dataRow['hocKyXet'];
                $this->namHocXet = $dataRow['namHocXet'];
                $this->maSinhVien = $dataRow['maSinhVien'];
                $this->coVanDuyet = $dataRow['coVanDuyet'];
                $this->khoaDuyet = $dataRow['khoaDuyet'];
                $this->diemTrungBinhChungHKXet = $dataRow['diemTrungBinhChungHKXet'];
            }
            
        }

        // CREATE
        public function createHocKyDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        hocKyXet = :hocKyXet, 
                        namHocXet = :namHocXet, 
                        maSinhVien = :maSinhVien,
                        coVanDuyet = :coVanDuyet,
                        khoaDuyet = :khoaDuyet,
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->hocKyXet=htmlspecialchars(strip_tags($this->hocKyXet));
            $this->namHocXet=htmlspecialchars(strip_tags($this->namHocXet));
            $this->maSinhVien=htmlspecialchars(strip_tags($this->maSinhVien));
            $this->coVanDuyet=htmlspecialchars(strip_tags($this->coVanDuyet));
            $this->khoaDuyet=htmlspecialchars(strip_tags($this->khoaDuyet));
            $this->diemTrungBinhChungHKXet=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        
            // bind data
            $stmt->bindParam(":hocKyXet", $this->hocKyXet);
            $stmt->bindParam(":namHocXet", $this->namHocXet);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":coVanDuyet", $this->coVanDuyet);
            $stmt->bindParam(":khoaDuyet", $this->khoaDuyet);
            $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        
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
                        namHocXet = :namHocXet, 
                        maSinhVien = :maSinhVien,
                        coVanDuyet = :coVanDuyet,
                        khoaDuyet = :khoaDuyet,
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet
                    WHERE 
                        hockydanhgia  = :hockydanhgia ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->hockydanhgia =htmlspecialchars(strip_tags($this->hockydanhgia ));
            $this->hocKyXet=htmlspecialchars(strip_tags($this->hocKyXet));
            $this->namHocXet=htmlspecialchars(strip_tags($this->namHocXet));
            $this->maSinhVien=htmlspecialchars(strip_tags($this->maSinhVien));
            $this->coVanDuyet=htmlspecialchars(strip_tags($this->coVanDuyet));
            $this->khoaDuyet=htmlspecialchars(strip_tags($this->khoaDuyet));
            $this->diemTrungBinhChungHKXet=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        
        
            // bind data
            $stmt->bindParam(":hockydanhgia ", $this->hockydanhgia );
            $stmt->bindParam(":hocKyXet", $this->hocKyXet);
            $stmt->bindParam(":namHocXet", $this->namHocXet);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":coVanDuyet", $this->coVanDuyet);
            $stmt->bindParam(":khoaDuyet", $this->khoaDuyet);
            $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteHocKyDanhGia(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE hockydanhgia  = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->hockydanhgia =htmlspecialchars(strip_tags($this->hockydanhgia ));
        
            $stmt->bindParam(1, $this->hockydanhgia );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>