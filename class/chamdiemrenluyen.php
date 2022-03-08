<?php
    class ChamDiemRenLuyen{
        // Connection
        private $conn;
        // Table
        private $db_table = "chamdiemrenluyen";
        // Columns
        public $maChamDiemRenLuyen ;
        public $maTieuChi3;
        public $diemSinhVienDanhGia;
        public $maSinhVien;
        public $diemLopDanhGia;
        public $diemTrungBinhChungHKTruoc;
        public $diemTrungBinhChungHKXet;


        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllChamDiemRenLuyen(){
            $sqlQuery = "SELECT maChamDiemRenLuyen , maTieuChi3, diemSinhVienDanhGia, maSinhVien, diemLopDanhGia, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleChamDiemRenLuyen(){
            $sqlQuery = "SELECT maChamDiemRenLuyen , maTieuChi3, diemSinhVienDanhGia, maSinhVien, diemLopDanhGia, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet FROM ". $this->db_table ."
                        WHERE maChamDiemRenLuyen  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maChamDiemRenLuyen );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maChamDiemRenLuyen  = $dataRow['maChamDiemRenLuyen '];
                $this->maTieuChi3 = $dataRow['maTieuChi3'];
                $this->diemSinhVienDanhGia = $dataRow['diemSinhVienDanhGia'];
                $this->maSinhVien = $dataRow['maSinhVien'];
                $this->diemLopDanhGia = $dataRow['diemLopDanhGia'];
                $this->diemTrungBinhChungHKTruoc = $dataRow['diemTrungBinhChungHKTruoc'];
                $this->diemTrungBinhChungHKXet = $dataRow['diemTrungBinhChungHKXet'];
            }
            
        }

        // CREATE
        public function createChamDiemRenLuyen(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maTieuChi3 = :maTieuChi3, 
                        diemSinhVienDanhGia = :diemSinhVienDanhGia, 
                        maSinhVien = :maSinhVien,
                        diemLopDanhGia = :diemLopDanhGia,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc,
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->diemSinhVienDanhGia=htmlspecialchars(strip_tags($this->diemSinhVienDanhGia));
            $this->maSinhVien=htmlspecialchars(strip_tags($this->maSinhVien));
            $this->diemLopDanhGia=htmlspecialchars(strip_tags($this->diemLopDanhGia));
            $this->diemTrungBinhChungHKTruoc=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
            $this->diemTrungBinhChungHKXet=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        
            // bind data
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":diemSinhVienDanhGia", $this->diemSinhVienDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":diemLopDanhGia", $this->diemLopDanhGia);
            $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
            $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateChamDiemRenLuyen(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        maTieuChi3 = :maTieuChi3, 
                        diemSinhVienDanhGia = :diemSinhVienDanhGia, 
                        maSinhVien = :maSinhVien,
                        diemLopDanhGia = :diemLopDanhGia,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc,
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet
                    WHERE 
                        maChamDiemRenLuyen  = :maChamDiemRenLuyen ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChamDiemRenLuyen =htmlspecialchars(strip_tags($this->maChamDiemRenLuyen ));
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->diemSinhVienDanhGia=htmlspecialchars(strip_tags($this->diemSinhVienDanhGia));
            $this->maSinhVien=htmlspecialchars(strip_tags($this->maSinhVien));
            $this->diemLopDanhGia=htmlspecialchars(strip_tags($this->diemLopDanhGia));
            $this->diemTrungBinhChungHKTruoc=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
            $this->diemTrungBinhChungHKXet=htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        
        
            // bind data
            $stmt->bindParam(":maChamDiemRenLuyen ", $this->maChamDiemRenLuyen );
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":diemSinhVienDanhGia", $this->diemSinhVienDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":diemLopDanhGia", $this->diemLopDanhGia);
            $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
            $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteChamDiemRenLuyen(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maChamDiemRenLuyen  = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maChamDiemRenLuyen =htmlspecialchars(strip_tags($this->maChamDiemRenLuyen ));
        
            $stmt->bindParam(1, $this->maChamDiemRenLuyen );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>