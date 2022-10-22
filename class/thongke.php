<?php
    class ThongKe{
        // Connection
        private $conn;
        // Columns
        public $maKhoa;
        public $maHocKyDanhGia;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        //GET ALL LOP THEO MA KHOA & MA HOC KY DANH GIA
        public function getAllLopTheoMaCoVan($maKhoa, $maHocKyDanhGia){
            $sqlQuery = "SELECT maLop, tenLop, maKhoa, maCoVanHocTap, maKhoaHoc FROM " . $this->db_table . " 
                        WHERE maCoVanHocTap = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maCoVanHocTap);
            $stmt->execute();
            return $stmt;
        }
        
        // GET SO SINH VIEN DA DUYET THEO MA LOP & MA HOC KY DANH GIA
        public function getSoSinhVienDaDuyet($maLop, $maHocKyDanhGia){
            $sqlQuery =  "SELECT table3.maLop, table3.siSo, table1.coVanDaDuyet, table2.khoaDaDuyet
                            FROM 
                                (SELECT lop.maLop, COUNT(sinhvien.maSinhVien) AS coVanDaDuyet
                                FROM phieurenluyen RIGHT JOIN sinhvien ON phieurenluyen.maSinhVien = sinhvien.maSinhVien
                                    RIGHT JOIN lop ON sinhvien.maLop = lop.maLop 
                                WHERE coVanDuyet = 1 AND maHocKyDanhGia = '$maHocKyDanhGia' AND lop.maLop = '$maLop') AS table1
                                INNER JOIN
                                (SELECT lop.maLop, COUNT(sinhvien.maSinhVien) AS khoaDaDuyet
                                FROM phieurenluyen RIGHT JOIN sinhvien ON phieurenluyen.maSinhVien = sinhvien.maSinhVien
                                    RIGHT JOIN lop ON sinhvien.maLop = lop.maLop 
                                WHERE khoaDuyet = 1 AND maHocKyDanhGia = '$maHocKyDanhGia' AND lop.maLop = '$maLop') AS table2
                                ON table1.maLop = table2.maLop
                                INNER JOIN
                                (SELECT lop.maLop, COUNT(*) AS siSo
                                    FROM sinhvien, lop
                                    WHERE sinhvien.maLop = lop.maLop AND lop.maLop = '$maLop') AS table3
                                ON table2.maLop = table3.maLop
                            LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            return $stmt;
        }
        
        // GET ALL KET QUA DRL SINH VIEN THEO MA LOP & MA HOC KY DANH GIA
        public function getAllKetQuaSinhVien($maLop, $maHocKyDanhGia){
            $sqlQuery =  "SELECT sv.maSinhVien, sv.hoTenSinhVien, sv.ngaySinh, sv.maLop, COALESCE(prl.diemTongCong, 0) AS diemTongCong, COALESCE(prl.xepLoai, 'Kém') AS xepLoai
                            FROM (SELECT * 
                                    FROM sinhvien 
                                    WHERE maLop = '$maLop') AS sv
                                LEFT JOIN
                                (SELECT * 
                                    FROM phieurenluyen 
                                    WHERE maHocKyDanhGia = '$maHocKyDanhGia') AS prl
                                ON sv.maSinhVien = prl.maSinhVien";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            
            return $stmt;
        }

    }
?>