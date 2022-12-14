<?php
    class Diemtrungbinhhe4 {
        // Connection
        private $conn;
        // Table
        private $db_table = "diemtrungbinhhe4";
        // Columns
        public $maDiemTrungBinh;
        public $diem;
        public $maHocKyDanhGia;
        public $maSinhVien;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllDiemTrungBinhHe4(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        //GET ALL DIEM TRUNG BINH HE 4 THEO MA HOC KY DANH GIA
        public function getAllDiemTrungBinhHe4TheoMaHocKyDanhGia($maHocKyDanhGia){
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maHocKyDanhGia = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maHocKyDanhGia);
            $stmt->execute();
            return $stmt;
        }

        //GET ALL DIEM TRUNG BINH HE 4 THEO MA SINH VIEN
        public function getAllDiemTrungBinhHe4TheoMaSinhVien($maSinhVien){
            $sqlQuery = "SELECT maDiemTrungBinh, diem, hockydanhgia.maHocKyDanhGia, maSinhVien, hocKyXet, namHocXet
                            FROM " . $this->db_table . " JOIN hockydanhgia ON diemtrungbinhhe4.maHocKyDanhGia = hockydanhgia.maHocKyDanhGia 
                        WHERE maSinhVien = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maSinhVien);
            $stmt->execute();
            return $stmt;
        }

        public function getAllDiemTrungBinhHe4TheoMaLop($maLop, $maHocKyDanhGia){
            $sqlQuery = "SELECT maDiemTrungBinh, ". $this->db_table .".maSinhVien, hoTenSinhVien, diem FROM " . $this->db_table . " 
                        JOIN sinhvien ON ". $this->db_table .".maSinhVien = sinhvien.maSinhVien WHERE maLop = ? AND maHocKyDanhGia = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maLop);
            $stmt->bindParam(2, $maHocKyDanhGia);
            $stmt->execute();
            return $stmt;
        }

        public function getAllNotHavingDiemTrungBinhHe4TheoMaLop($maLop, $maHocKyDanhGia){
            $sqlQuery = "SELECT sinhvien.*
                        FROM sinhvien
                        WHERE maLop = '$maLop'
                        AND sinhvien.maSinhVien NOT IN (
                            SELECT diemtrungbinhhe4.maSinhVien
                            FROM diemtrungbinhhe4, sinhvien
                            WHERE diemtrungbinhhe4.maSinhVien = sinhvien.maSinhVien
                            AND maLop = '$maLop'
                            AND maHocKyDanhGia = '$maHocKyDanhGia'
                        )";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $stmt;
        }

        // GET SINGLE DIEM TRUNG BINH HE 4
        public function getSingleDiemTrungBinhHe4() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "
                            WHERE maDiemTrungBinh  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maDiemTrungBinh);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dataRow != null) {
                $this->maDiemTrungBinh  = $dataRow['maDiemTrungBinh'];
                $this->diem = $dataRow['diem'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
                $this->maSinhVien = $dataRow['maSinhVien'];
            }
        }

        // GET TON TAI DIEM CUA SINH VIEN THEO MA HOC KY DANH GIA
        public function getTonTaiDiemCuaSinhVienTheoMaHocKyDanhGia($maHocKyDanhGia, $maSinhVien, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE maSinhVien" . 
                            ($isEqual ? " = '$maSinhVien' " : " LIKE '%$maSinhVien%' ") . "
                            AND maHocKyDanhGia" .
                            ($isEqual ? " = '$maHocKyDanhGia' " : " LIKE '%$maHocKyDanhGia%' ");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        //getDIEM HE 4 THEO MA DIEM TRUNG BINH
        public function getDiemHe4TheoMaDiemTrungBinh($maDiemTrungBinh, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maDiemTrungBinh" . 
                        ($isEqual ? " = '$maDiemTrungBinh'" : " LIKE '%$maDiemTrungBinh%'");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET SINGLE DIEM TRUNG BINH HE 4 THEO MSSV VA MA HOC KY DANH GIA
        public function getSingleTheoMSSVVaMaHKDG($maSinhVien, $maHocKyDanhGia) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "
                        WHERE maSinhVien  = ? AND maHocKyDanhGia = ? 
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maSinhVien);
            $stmt->bindParam(2, $maHocKyDanhGia);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dataRow != null) {
                $this->maDiemTrungBinh  = $dataRow['maDiemTrungBinh'];
                $this->diem = $dataRow['diem'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
                $this->maSinhVien = $dataRow['maSinhVien'];
            }
        }

        // CREATE
        public function createDiemTrungBinhHe4() {
            $sqlQuery = "INSERT INTO
                            " . $this->db_table . "
                        SET
                            maDiemTrungBinh = :maDiemTrungBinh, 
                            diem = :diem,
                            maHocKyDanhGia = :maHocKyDanhGia,
                            maSinhVien = :maSinhVien";

            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maDiemTrungBinh = htmlspecialchars(strip_tags($this->maDiemTrungBinh));
            $this->diem = htmlspecialchars(strip_tags($this->diem));
            $this->maHocKyDanhGia = htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));

            // bind data
            $stmt->bindParam(":maDiemTrungBinh", $this->maDiemTrungBinh);
            $stmt->bindParam(":diem", $this->diem);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        // UPDATE
        public function updateDiemTrungBinhHe4(){
            $sqlQuery = "UPDATE ". $this->db_table ." 
                    SET 
                        diem = :diem,
                        maHocKyDanhGia = :maHocKyDanhGia,
                        maSinhVien = :maSinhVien
                    WHERE 
                        maDiemTrungBinh = :maDiemTrungBinh";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->diem=htmlspecialchars(strip_tags($this->diem));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->maSinhVien=htmlspecialchars(strip_tags($this->maSinhVien));
            $this->maDiemTrungBinh=htmlspecialchars(strip_tags($this->maDiemTrungBinh));
 
            // bind data
            $stmt->bindParam(":diem", $this->diem);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":maDiemTrungBinh", $this->maDiemTrungBinh);
         
            if($stmt->execute()){
               return true;
            }
            return false;
        }
    }
?>