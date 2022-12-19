<?php
    class ThongKeCanhCao{
        // Connection
        private $conn;
        // Columns
        public $maLop;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        //GET ALL SINH VIEN CO DIEM YEU KEM THEO LOP
        public function getAllSinhVienCoDiemYeuKemByLop($maLop) {
            $sqlQuery =  "SELECT sinhvien.*, COUNT(*) AS soLanYeuKem
                        FROM sinhvien, phieurenluyen
                        WHERE sinhvien.maSinhVien = phieurenluyen.maSinhVien
                            AND maLop = '$maLop'
                            AND diemTongCong < 50
                            AND phieurenluyen.khoaDuyet = 1
                        GROUP BY sinhvien.maSinhVien";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $stmt;
        }

        // GET ALL SINH VIEN CO DIEM YEU KEM
        public function getAllSinhVienCoDiemYeuKem($maKhoa) {
            $sqlQuery =  "SELECT sinhvien.*, COUNT(*) AS soLanYeuKem
                        FROM sinhvien, phieurenluyen, khoa, lop
                        WHERE sinhvien.maSinhVien = phieurenluyen.maSinhVien
                            AND lop.maKhoa = khoa.maKhoa
                            AND sinhvien.maLop = lop.maLop
                            AND diemTongCong < 50
                            AND phieurenluyen.khoaDuyet = 1
                            AND khoa.maKhoa = '$maKhoa'
                        GROUP BY sinhvien.maSinhVien
                        ORDER BY sinhvien.maLop ASC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $stmt;
        }

        //GET ALL SINH VIEN KHONG CO DIEM YEU KEM
        public function getAllSinhVienKhongCoDiemYeuKem($maLop) {
            $sqlQuery =  "SELECT sinhvien.*
                        FROM sinhvien
                        WHERE maLop = '$maLop'
                        AND sinhvien.maSinhVien NOT IN (
                            SELECT sinhvien.maSinhVien
                            FROM sinhvien, phieurenluyen
                            WHERE sinhvien.maSinhVien = phieurenluyen.maSinhVien
                                AND maLop = '$maLop'
                                AND diemTongCong < 50
                                AND phieurenluyen.khoaDuyet = 1
                            GROUP BY sinhvien.maSinhVien)";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            return $stmt;
        }
        
/**
 * SELECT sinhvien.*
FROM sinhvien
WHERE maLop = "DCT1188"
AND sinhvien.maSinhVien NOT IN (
    SELECT sinhvien.maSinhVien
    FROM sinhvien, phieurenluyen
    WHERE sinhvien.maSinhVien = phieurenluyen.maSinhVien
        AND maLop = "DCT1188"
        AND diemTongCong < 50
    GROUP BY sinhvien.maSinhVien
);
 */
    }
?>