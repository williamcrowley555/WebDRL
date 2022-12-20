<?php
    class KhieuNai{
        // Connection
        private $conn;
        // Table
        private $db_table = "khieunai";
        // Columns
        public $maKhieuNai ;
        public $maPhieuRenLuyen;
        public $lyDoKhieuNai;
        public $minhChung;
        public $trangThai;
        public $thoiGianKhieuNai;
        public $loiNhan;
        public $lyDoTuChoi;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllKhieuNai() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " ORDER BY thoiGianKhieuNai DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // GET DETAILS ALL THEO MA KHOA & MA KHOA HOC & MA HOC KY DANH GIA
        public function getDetailsAll($maKhoa, $maKhoaHoc, $maHocKyDanhGia) {
            $sqlQuery = "SELECT * 
                        FROM khieunai, phieurenluyen, sinhvien, lop
                        WHERE khieunai.maPhieuRenLuyen = phieurenluyen.maPhieuRenLuyen 
                            AND phieurenluyen.maSinhVien = sinhvien.maSinhVien
                            AND sinhvien.maLop = lop.maLop
                            AND lop.maKhoa = ? AND lop.maKhoaHoc = ?
                            AND phieurenluyen.maHocKyDanhGia = ? 
                        ORDER BY thoiGianKhieuNai DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maKhoa);
            $stmt->bindParam(2, $maKhoaHoc);
            $stmt->bindParam(3, $maHocKyDanhGia);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL THEO MA SO SINH VIEN
        public function getDetailsKhieuNaiTheoMSSV($mssv, $isEqual = true)
        {
            $sqlQuery = "SELECT * 
                        FROM khieunai, phieurenluyen, sinhvien, lop  
                        WHERE khieunai.maPhieuRenLuyen = phieurenluyen.maPhieuRenLuyen 
                            AND phieurenluyen.maSinhVien = sinhvien.maSinhVien
                            AND sinhvien.maLop = lop.maLop
                            AND phieurenluyen.maSinhVien" . 
                            ($isEqual ? " = '$mssv'" : " LIKE '%$mssv%'") . 
                        " ORDER BY thoiGianKhieuNai DESC";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET ALL THEO MA SO SINH VIEN VA MA KHOA
        public function getDetailsKhieuNaiTheoMSSVVaMaKhoa($mssv, $maKhoa, $isEqual = true)
        {
            $sqlQuery = "SELECT * 
                        FROM khieunai, phieurenluyen, sinhvien, lop  
                        WHERE  khieunai.maPhieuRenLuyen = phieurenluyen.maPhieuRenLuyen 
                            AND phieurenluyen.maSinhVien = sinhvien.maSinhVien
                            AND sinhvien.maLop = lop.maLop
                            AND lop.maKhoa = '$maKhoa' 
                            AND phieurenluyen.maSinhVien" . 
                            ($isEqual ? " = '$mssv'" : " LIKE '%$mssv%'") . 
                        " ORDER BY thoiGianKhieuNai DESC";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // GET SINGLE DETAILS THEO MA KHIEU NAI
        public function getSingleDetailsTheoMaKhieuNai($maKhieuNai) {
            $sqlQuery = "SELECT * 
                        FROM khieunai, phieurenluyen, sinhvien, lop
                        WHERE khieunai.maPhieuRenLuyen = phieurenluyen.maPhieuRenLuyen 
                            AND phieurenluyen.maSinhVien = sinhvien.maSinhVien
                            AND sinhvien.maLop = lop.maLop
                            AND maKhieuNai = ? 
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maKhieuNai);
            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($dataRow != null){
                $this->maKhieuNai = $dataRow['maKhieuNai'];
                $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
                $this->lyDoKhieuNai = $dataRow['lyDoKhieuNai'];
                $this->minhChung = $dataRow['minhChung'];
                $this->trangThai = $dataRow['trangThai'];
                $this->thoiGianKhieuNai = $dataRow['thoiGianKhieuNai'];
                $this->loiNhan = $dataRow['loiNhan'];
                $this->lyDoTuChoi = $dataRow['lyDoTuChoi'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
                $this->maSinhVien = $dataRow['maSinhVien'];
                $this->hoTenSinhVien = $dataRow['hoTenSinhVien'];
                $this->email = $dataRow['email'];
                $this->sdt = $dataRow['sdt'];
                $this->maLop = $dataRow['maLop'];
            }
        }
        
        // READ single
        public function getSingleKhieuNai(){
            $sqlQuery = "SELECT * FROM ". $this->db_table .
                        " WHERE maKhieuNai = '$this->maKhieuNai'
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($dataRow != null){
                $this->maKhieuNai = $dataRow['maKhieuNai'];
                $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
                $this->lyDoKhieuNai = $dataRow['lyDoKhieuNai'];
                $this->minhChung = $dataRow['minhChung'];
                $this->trangThai = $dataRow['trangThai'];
                $this->thoiGianKhieuNai = $dataRow['thoiGianKhieuNai'];
                $this->loiNhan = $dataRow['loiNhan'];
                $this->lyDoTuChoi = $dataRow['lyDoTuChoi'];
            }
        }

        //GET KHIEU NAI THEO MA PHIEU REN LUYEN
        public function getKhieuNaiTheoMaPRL($maPhieuRenLuyen){
            $sqlQuery = "SELECT * 
                        FROM khieunai
                        WHERE maPhieuRenLuyen = ?
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maSinhVien);
            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maKhieuNai = $dataRow['maKhieuNai'];
                $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
                $this->lyDoKhieuNai = $dataRow['lyDoKhieuNai'];
                $this->minhChung = $dataRow['minhChung'];
                $this->trangThai = $dataRow['trangThai'];
                $this->thoiGianKhieuNai = $dataRow['thoiGianKhieuNai'];
                $this->loiNhan = $dataRow['loiNhan'];
                $this->lyDoTuChoi = $dataRow['lyDoTuChoi'];
            }
        }

        //GET KHIEU NAI THEO MA SINH VIEN VA MA HOC KY DANH GIA
        public function getKhieuNaiTheoMSSVVaMaHKDG($maSinhVien, $maHocKyDanhGia){
            $sqlQuery = "SELECT * 
                        FROM khieunai, phieurenluyen
                        WHERE khieunai.maPhieuRenLuyen = phieurenluyen.maPhieuRenLuyen 
                            AND phieurenluyen.maSinhVien = ? 
                            AND phieurenluyen.maHocKyDanhGia = ?
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maSinhVien);
            $stmt->bindParam(2, $maHocKyDanhGia);
            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maKhieuNai = $dataRow['maKhieuNai'];
                $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
                $this->lyDoKhieuNai = $dataRow['lyDoKhieuNai'];
                $this->minhChung = $dataRow['minhChung'];
                $this->trangThai = $dataRow['trangThai'];
                $this->thoiGianKhieuNai = $dataRow['thoiGianKhieuNai'];
                $this->loiNhan = $dataRow['loiNhan'];
                $this->lyDoTuChoi = $dataRow['lyDoTuChoi'];
            }
        }

        // CREATE
        public function createKhieuNai(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maKhieuNai = :maKhieuNai,
                        maPhieuRenLuyen = :maPhieuRenLuyen, 
                        lyDoKhieuNai = :lyDoKhieuNai, 
                        minhChung = :minhChung,
                        trangThai = :trangThai,
                        thoiGianKhieuNai = :thoiGianKhieuNai,
                        loiNhan = :loiNhan,
                        lyDoTuChoi = :lyDoTuChoi";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhieuNai=htmlspecialchars(strip_tags($this->maKhieuNai));
            $this->maPhieuRenLuyen=htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
            $this->lyDoKhieuNai=htmlspecialchars(strip_tags($this->lyDoKhieuNai));
            $this->minhChung=htmlspecialchars(strip_tags($this->minhChung));
            $this->trangThai=htmlspecialchars(strip_tags($this->trangThai));
            $this->thoiGianKhieuNai=htmlspecialchars(strip_tags($this->thoiGianKhieuNai));
            $this->loiNhan=htmlspecialchars(strip_tags($this->loiNhan));
            $this->lyDoTuChoi=htmlspecialchars(strip_tags($this->lyDoTuChoi));
        
            // bind data
            $stmt->bindParam(":maKhieuNai", $this->maKhieuNai);
            $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
            $stmt->bindParam(":lyDoKhieuNai", $this->lyDoKhieuNai);
            $stmt->bindParam(":minhChung", $this->minhChung);
            $stmt->bindParam(":trangThai", $this->trangThai);
            $stmt->bindParam(":thoiGianKhieuNai", $this->thoiGianKhieuNai);
            $stmt->bindParam(":loiNhan", $this->loiNhan);
            $stmt->bindParam(":lyDoTuChoi", $this->lyDoTuChoi);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateKhieuNai(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        maPhieuRenLuyen = :maPhieuRenLuyen, 
                        lyDoKhieuNai = :lyDoKhieuNai, 
                        minhChung = :minhChung,
                        trangThai = :trangThai,
                        thoiGianKhieuNai = :thoiGianKhieuNai,
                        loiNhan = :loiNhan,
                        lyDoTuChoi = :lyDoTuChoi
                    WHERE 
                        maKhieuNai = :maKhieuNai";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhieuNai=htmlspecialchars(strip_tags($this->maKhieuNai));
            $this->maPhieuRenLuyen=htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
            $this->lyDoKhieuNai=htmlspecialchars(strip_tags($this->lyDoKhieuNai));
            $this->minhChung=htmlspecialchars(strip_tags($this->minhChung));
            $this->trangThai=htmlspecialchars(strip_tags($this->trangThai));
            $this->thoiGianKhieuNai=htmlspecialchars(strip_tags($this->thoiGianKhieuNai));
            $this->loiNhan=htmlspecialchars(strip_tags($this->loiNhan));
            $this->lyDoTuChoi=htmlspecialchars(strip_tags($this->lyDoTuChoi));
        
            // bind data
            $stmt->bindParam(":maKhieuNai", $this->maKhieuNai);
            $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
            $stmt->bindParam(":lyDoKhieuNai", $this->lyDoKhieuNai);
            $stmt->bindParam(":minhChung", $this->minhChung);
            $stmt->bindParam(":trangThai", $this->trangThai);
            $stmt->bindParam(":thoiGianKhieuNai", $this->thoiGianKhieuNai);
            $stmt->bindParam(":loiNhan", $this->loiNhan);
            $stmt->bindParam(":lyDoTuChoi", $this->lyDoTuChoi);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE TRẠNG THÁI
        public function updateKhieuNai_TrangThai(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        trangThai = :trangThai,
                        loiNhan = :loiNhan,
                        lyDoTuChoi = :lyDoTuChoi
                    WHERE 
                        maKhieuNai = :maKhieuNai";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maKhieuNai=htmlspecialchars(strip_tags($this->maKhieuNai));
            $this->trangThai=htmlspecialchars(strip_tags($this->trangThai));
            $this->loiNhan=htmlspecialchars(strip_tags($this->loiNhan));
            $this->lyDoTuChoi=htmlspecialchars(strip_tags($this->lyDoTuChoi));
        
            // bind data
            $stmt->bindParam(":maKhieuNai", $this->maKhieuNai);
            $stmt->bindParam(":trangThai", $this->trangThai);
            $stmt->bindParam(":loiNhan", $this->loiNhan);
            $stmt->bindParam(":lyDoTuChoi", $this->lyDoTuChoi);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteKhieuNaiTheoMaKhieuNai($maKhieuNai){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maKhieuNai = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maKhieuNai = htmlspecialchars(strip_tags($maKhieuNai));
        
            $stmt->bindParam(1, $maKhieuNai);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }

?>