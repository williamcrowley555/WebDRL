<?php
    class HoatDongDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "hoatdongdanhgia";
        // Columns
        public $maHoatDong;
        public $maTieuChi3;
        public $maTieuChi2;
        public $maKhoa;
        public $tenHoatDong;
        public $diemNhanDuoc;
        public $diaDiemDienRaHoatDong;
        public $maQRDiaDiem;
        public $maHocKyDanhGia;
        public $thoiGianBatDauDiemDanh;
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
            $sqlQuery = "SELECT $this->db_table.*, 
                            case
                                when $this->db_table.maTieuChi2 != 0 then tieuchicap2.noidung
                                else tieuchicap3.noidung
                            end as noiDungTieuChi
                        FROM $this->db_table
                            LEFT JOIN tieuchicap2 ON maTieuChi2 = matc2
                            LEFT JOIN tieuchicap3 ON maTieuChi3 = matc3
                        ORDER BY maHocKyDanhGia DESC, thoiGianBatDauHoatDong DESC, thoiGianKetThucHoatDong DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET HOATDONG THEO MA HOAT DONG
        public function getHoatDongTheoMaHD($maHD, $isEqual = true)
        {
            $sqlQuery = "SELECT $this->db_table.*, 
                            case
                                when $this->db_table.maTieuChi2 != 0 then tieuchicap2.noidung
                                else tieuchicap3.noidung
                            end as noiDungTieuChi
                        FROM $this->db_table
                            LEFT JOIN tieuchicap2 ON maTieuChi2 = matc2
                            LEFT JOIN tieuchicap3 ON maTieuChi3 = matc3" 
                        . " WHERE UPPER(maHoatDong)" . 
                            ($isEqual ? " =  UPPER('$maHD')" : " LIKE  UPPER('%$maHD%')")
                        . " ORDER BY maHocKyDanhGia DESC, thoiGianBatDauHoatDong DESC, thoiGianKetThucHoatDong DESC";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // GET HOATDONG THEO KHOANG THOI GIAN
        public function getHoatDongTheoKhoangThoiGian($from, $to)
        {
            $sqlQuery = "SELECT $this->db_table.*, 
                            case
                                when $this->db_table.maTieuChi2 != 0 then tieuchicap2.noidung
                                else tieuchicap3.noidung
                            end as noiDungTieuChi
                        FROM $this->db_table
                            LEFT JOIN tieuchicap2 ON maTieuChi2 = matc2
                            LEFT JOIN tieuchicap3 ON maTieuChi3 = matc3" 
                        . " WHERE '$from' <= thoiGianBatDauHoatDong AND thoiGianBatDauHoatDong <= '$to'"
                        . " ORDER BY maHocKyDanhGia DESC, thoiGianBatDauHoatDong DESC, thoiGianKetThucHoatDong DESC";
    
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // READ single
        public function getSingleHoatDongDanhGia(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ."
                        WHERE maHoatDong  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maHoatDong);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maHoatDong   = $dataRow['maHoatDong'];
                $this->maTieuChi3 = $dataRow['maTieuChi3'];
                $this->maTieuChi2 = $dataRow['maTieuChi2'];
                $this->maKhoa = $dataRow['maKhoa'];
                $this->tenHoatDong = $dataRow['tenHoatDong'];
                $this->diemNhanDuoc = $dataRow['diemNhanDuoc'];
                $this->diaDiemDienRaHoatDong = $dataRow['diaDiemDienRaHoatDong'];
                $this->maQRDiaDiem = $dataRow['maQRDiaDiem'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
                $this->thoiGianBatDauDiemDanh = $dataRow['thoiGianBatDauDiemDanh'];
                $this->thoiGianBatDauHoatDong = $dataRow['thoiGianBatDauHoatDong'];
                $this->thoiGianKetThucHoatDong = $dataRow['thoiGianKetThucHoatDong'];
            }
        }

        // CREATE
        public function createHoatDongDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maHoatDong = :maHoatDong, 
                        maTieuChi3 = :maTieuChi3, 
                        maTieuChi2 = :maTieuChi2,
                        maKhoa = :maKhoa, 
                        tenHoatDong = :tenHoatDong,
                        diemNhanDuoc = :diemNhanDuoc,
                        diaDiemDienRaHoatDong = :diaDiemDienRaHoatDong,
                        maQRDiaDiem = :maQRDiaDiem,
                        maHocKyDanhGia = :maHocKyDanhGia,
                        thoiGianBatDauDiemDanh = :thoiGianBatDauDiemDanh,
                        thoiGianBatDauHoatDong = :thoiGianBatDauHoatDong,
                        thoiGianKetThucHoatDong = :thoiGianKetThucHoatDong";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHoatDong=htmlspecialchars(strip_tags($this->maHoatDong));
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maTieuChi2=htmlspecialchars(strip_tags($this->maTieuChi2));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenHoatDong=htmlspecialchars(strip_tags($this->tenHoatDong));
            $this->diemNhanDuoc=htmlspecialchars(strip_tags($this->diemNhanDuoc));
            $this->diaDiemDienRaHoatDong=htmlspecialchars(strip_tags($this->diaDiemDienRaHoatDong));
            $this->maQRDiaDiem=htmlspecialchars(strip_tags($this->maQRDiaDiem));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->thoiGianBatDauDiemDanh=htmlspecialchars(strip_tags($this->thoiGianBatDauDiemDanh));
            $this->thoiGianBatDauHoatDong=htmlspecialchars(strip_tags($this->thoiGianBatDauHoatDong));
            $this->thoiGianKetThucHoatDong=htmlspecialchars(strip_tags($this->thoiGianKetThucHoatDong));
        
            // bind data
            $stmt->bindParam(":maHoatDong", $this->maHoatDong);
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maTieuChi2", $this->maTieuChi2);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenHoatDong", $this->tenHoatDong);
            $stmt->bindParam(":diemNhanDuoc", $this->diemNhanDuoc);
            $stmt->bindParam(":diaDiemDienRaHoatDong", $this->diaDiemDienRaHoatDong);
            $stmt->bindParam(":maQRDiaDiem", $this->maQRDiaDiem);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":thoiGianBatDauDiemDanh", $this->thoiGianBatDauDiemDanh);
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
                        maTieuChi2 = :maTieuChi2, 
                        maKhoa = :maKhoa, 
                        tenHoatDong = :tenHoatDong,
                        diemNhanDuoc = :diemNhanDuoc,
                        diaDiemDienRaHoatDong = :diaDiemDienRaHoatDong,
                        maHocKyDanhGia = :maHocKyDanhGia,
                        thoiGianBatDauDiemDanh = :thoiGianBatDauDiemDanh,
                        thoiGianBatDauHoatDong = :thoiGianBatDauHoatDong,
                        thoiGianKetThucHoatDong = :thoiGianKetThucHoatDong
                    WHERE 
                        maHoatDong   = :maHoatDong  ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maHoatDong = htmlspecialchars(strip_tags($this->maHoatDong));
            $this->maTieuChi3=htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maTieuChi2=htmlspecialchars(strip_tags($this->maTieuChi2));
            $this->maKhoa=htmlspecialchars(strip_tags($this->maKhoa));
            $this->tenHoatDong=htmlspecialchars(strip_tags($this->tenHoatDong));
            $this->diemNhanDuoc=htmlspecialchars(strip_tags($this->diemNhanDuoc));
            $this->diaDiemDienRaHoatDong=htmlspecialchars(strip_tags($this->diaDiemDienRaHoatDong));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
            $this->thoiGianBatDauDiemDanh=htmlspecialchars(strip_tags($this->thoiGianBatDauDiemDanh));
            $this->thoiGianBatDauHoatDong=htmlspecialchars(strip_tags($this->thoiGianBatDauHoatDong));
            $this->thoiGianKetThucHoatDong=htmlspecialchars(strip_tags($this->thoiGianKetThucHoatDong));
        
        
            // bind data
            $stmt->bindParam(":maHoatDong", $this->maHoatDong  );
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maTieuChi2", $this->maTieuChi2);
            $stmt->bindParam(":maKhoa", $this->maKhoa);
            $stmt->bindParam(":tenHoatDong", $this->tenHoatDong);
            $stmt->bindParam(":diemNhanDuoc", $this->diemNhanDuoc);
            $stmt->bindParam(":diaDiemDienRaHoatDong", $this->diaDiemDienRaHoatDong);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
            $stmt->bindParam(":thoiGianBatDauDiemDanh", $this->thoiGianBatDauDiemDanh);
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
        
            $this->maHoatDong = htmlspecialchars(strip_tags($this->maHoatDong  ));
        
            $stmt->bindParam(1, $this->maHoatDong  );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>