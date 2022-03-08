<?php
    class HoatDongDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "hoatdongdanhgia";
        // Columns
        public $maHoatDong;
        public $maTieuChi3;
        public $maKhoa;
        public $tenHoatDong;
        public $diemNhanDuoc;
        public $diaDiemDienRaHoatDong;
        public $maQRDiaDiem;
        public $thoiGianBatDauHoatDong;
        public $thoiGianKetThucHoatDong;


        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllHoatDongDanhGia(){
            $sqlQuery = "SELECT maHoatDong  , maTieuChi3, maKhoa, tenHoatDong, diemNhanDuoc, diaDiemDienRaHoatDong, maQRDiaDiem, thoiGianBatDauHoatDong, thoiGianKetThucHoatDong FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleHoatDongDanhGia(){
            $sqlQuery = "SELECT maHoatDong  , maTieuChi3, maKhoa, tenHoatDong, diemNhanDuoc, diaDiemDienRaHoatDong, maQRDiaDiem, thoiGianBatDauHoatDong, thoiGianKetThucHoatDong FROM ". $this->db_table ."
                        WHERE maHoatDong   = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maHoatDong  );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maHoatDong   = $dataRow['maHoatDong  '];
                $this->maTieuChi3 = $dataRow['maTieuChi3'];
                $this->maKhoa = $dataRow['maKhoa'];
                $this->tenHoatDong = $dataRow['tenHoatDong'];
                $this->diemNhanDuoc = $dataRow['diemNhanDuoc'];
                $this->diaDiemDienRaHoatDong = $dataRow['diaDiemDienRaHoatDong'];
                $this->maQRDiaDiem = $dataRow['maQRDiaDiem'];
                $this->thoiGianBatDauHoatDong = $dataRow['thoiGianBatDauHoatDong'];
                $this->thoiGianKetThucHoatDong = $dataRow['thoiGianKetThucHoatDong'];
            }
            
        }

        // CREATE
        public function createHoatDongDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maTieuChi3 = :maTieuChi3, 
                        maKhoa = :maKhoa, 
                        tenHoatDong = :tenHoatDong,
                        diemNhanDuoc = :diemNhanDuoc,
                        diaDiemDienRaHoatDong = :diaDiemDienRaHoatDong,
                        maQRDiaDiem = :maQRDiaDiem,
                        thoiGianBatDauHoatDong = :thoiGianBatDauHoatDong,
                        thoiGianKetThucHoatDong = :thoiGianKetThucHoatDong";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenHoatDong=htmlspecialchars(strip_tags($this->tenHoatDong));
            $this->diemNhanDuoc=htmlspecialchars(strip_tags($this->diemNhanDuoc));
            $this->diaDiemDienRaHoatDong=htmlspecialchars(strip_tags($this->diaDiemDienRaHoatDong));
            $this->maQRDiaDiem=htmlspecialchars(strip_tags($this->maQRDiaDiem));
            $this->thoiGianBatDauHoatDong=htmlspecialchars(strip_tags($this->thoiGianBatDauHoatDong));
            $this->thoiGianKetThucHoatDong=htmlspecialchars(strip_tags($this->thoiGianKetThucHoatDong));
        
            // bind data
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenHoatDong", $this->tenHoatDong);
            $stmt->bindParam(":diemNhanDuoc", $this->diemNhanDuoc);
            $stmt->bindParam(":diaDiemDienRaHoatDong", $this->diaDiemDienRaHoatDong);
            $stmt->bindParam(":maQRDiaDiem", $this->maQRDiaDiem);
            $stmt->bindParam(":thoiGianBatDauHoatDong", $this->thoiGianBatDauHoatDong);
            $stmt->bindParam(":thoiGianKetThucHoatDong", $this->thoiGianKetThucHoatDong);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateHoatDongDanhGia(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        maTieuChi3 = :maTieuChi3, 
                        maKhoa = :maKhoa, 
                        tenHoatDong = :tenHoatDong,
                        diemNhanDuoc = :diemNhanDuoc,
                        diaDiemDienRaHoatDong = :diaDiemDienRaHoatDong,
                        maQRDiaDiem = :maQRDiaDiem,
                        thoiGianBatDauHoatDong = :thoiGianBatDauHoatDong,
                        thoiGianKetThucHoatDong = :thoiGianKetThucHoatDong
                    WHERE 
                        maHoatDong   = :maHoatDong  ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHoatDong  =htmlspecialchars(strip_tags($this->maHoatDong  ));
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenHoatDong=htmlspecialchars(strip_tags($this->tenHoatDong));
            $this->diemNhanDuoc=htmlspecialchars(strip_tags($this->diemNhanDuoc));
            $this->diaDiemDienRaHoatDong=htmlspecialchars(strip_tags($this->diaDiemDienRaHoatDong));
            $this->maQRDiaDiem=htmlspecialchars(strip_tags($this->maQRDiaDiem));
            $this->thoiGianBatDauHoatDong=htmlspecialchars(strip_tags($this->thoiGianBatDauHoatDong));
            $this->thoiGianKetThucHoatDong=htmlspecialchars(strip_tags($this->thoiGianKetThucHoatDong));
        
        
            // bind data
            $stmt->bindParam(":maHoatDong  ", $this->maHoatDong  );
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenHoatDong", $this->tenHoatDong);
            $stmt->bindParam(":diemNhanDuoc", $this->diemNhanDuoc);
            $stmt->bindParam(":diaDiemDienRaHoatDong", $this->diaDiemDienRaHoatDong);
            $stmt->bindParam(":maQRDiaDiem", $this->maQRDiaDiem);
            $stmt->bindParam(":thoiGianBatDauHoatDong", $this->thoiGianBatDauHoatDong);
            $stmt->bindParam(":thoiGianKetThucHoatDong", $this->thoiGianKetThucHoatDong);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteHoatDongDanhGia(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maHoatDong   = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maHoatDong  =htmlspecialchars(strip_tags($this->maHoatDong  ));
        
            $stmt->bindParam(1, $this->maHoatDong  );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>