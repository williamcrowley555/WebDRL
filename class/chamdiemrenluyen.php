<?php
    class ChamDiemRenLuyen{
        
        // Connection
        private $conn;
        // Table
        private $db_table = "chamdiemrenluyen";
        // Columns
        public $maChamDiemRenLuyen;
        public $maPhieuRenLuyen;
        public $maTieuChi3;
        public $maTieuChi2;
        public $diemSinhVienDanhGia;
        public $maSinhVien;
        public $diemLopDanhGia;
        public $ghiChu;



        // Db connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllChamDiemRenLuyen()
        {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleChamDiemRenLuyen_TheoPhieuRenLuyen($maPhieuRenLuyen)
        {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "
                            WHERE maPhieuRenLuyen  = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maPhieuRenLuyen);
            $stmt->execute();

            return $stmt;
        }

        // READ single
        public function getSingleChamDiemRenLuyen()
        {
            $sqlQuery = "SELECT  maChamDiemRenLuyen, maPhieuRenLuyen, maTieuChi2, maTieuChi3, diemSinhVienDanhGia, maSinhVien, diemLopDanhGia, ghiChu FROM " . $this->db_table . "
                            WHERE maChamDiemRenLuyen  = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maChamDiemRenLuyen);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dataRow != null) {
                $this->maChamDiemRenLuyen  = $dataRow['maChamDiemRenLuyen'];
                $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
                $this->maTieuChi3 = $dataRow['maTieuChi3'];
                $this->maTieuChi2 = $dataRow['maTieuChi2'];
                $this->maSinhVien = $dataRow['maSinhVien'];
                $this->diemLopDanhGia = $dataRow['diemSinhVienDanhGia'];
                $this->diemLopDanhGia = $dataRow['diemLopDanhGia'];
                $this->diemLopDanhGia = $dataRow['ghiChu'];
                
            }
        }


        // CREATE
        public function createChamDiemRenLuyen()
        {
            $sqlQuery = "INSERT INTO
                            " . $this->db_table . "
                        SET
                            maPhieuRenLuyen = :maPhieuRenLuyen,
                            maTieuChi3 = :maTieuChi3, 
                            maTieuChi2 = :maTieuChi2,
                            maSinhVien = :maSinhVien,
                            diemSinhVienDanhGia = :diemSinhVienDanhGia, 
                            diemLopDanhGia = :diemLopDanhGia,
                            ghiChu = :ghiChu";


            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
            $this->maTieuChi3 = htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maTieuChi2 = htmlspecialchars(strip_tags($this->maTieuChi2));
            $this->diemSinhVienDanhGia = htmlspecialchars(strip_tags($this->diemSinhVienDanhGia));
            $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
            $this->diemLopDanhGia = htmlspecialchars(strip_tags($this->diemLopDanhGia));
            $this->ghiChu = htmlspecialchars(strip_tags($this->ghiChu));
            
            

            // bind data
            $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maTieuChi2", $this->maTieuChi2);
            $stmt->bindParam(":diemSinhVienDanhGia", $this->diemSinhVienDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":diemLopDanhGia", $this->diemLopDanhGia);
            $stmt->bindParam(":ghiChu", $this->ghiChu);
            
       
            if ($stmt->execute()) {
                return true;
            }
          

        }


        // UPDATE
        public function updateChamDiemRenLuyen()
        {
            $sqlQuery = "UPDATE
                            " . $this->db_table . "
                        SET
                            maPhieuRenLuyen = :maPhieuRenLuyen,
                            maTieuChi3 = :maTieuChi3, 
                            maTieuChi2 = :maTieuChi2,
                            maSinhVien = :maSinhVien,
                            diemSinhVienDanhGia = :diemSinhVienDanhGia, 
                            diemLopDanhGia = :diemLopDanhGia,
                            ghiChu = :ghiChu
                        WHERE 
                            maChamDiemRenLuyen = :maChamDiemRenLuyen";

            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChamDiemRenLuyen = htmlspecialchars(strip_tags($this->maChamDiemRenLuyen));
            $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
            $this->maTieuChi3 = htmlspecialchars(strip_tags($this->maTieuChi3));
            $this->maTieuChi2 = htmlspecialchars(strip_tags($this->maTieuChi2));
            $this->diemSinhVienDanhGia = htmlspecialchars(strip_tags($this->diemSinhVienDanhGia));
            $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
            $this->diemLopDanhGia = htmlspecialchars(strip_tags($this->diemLopDanhGia));
            $this->ghiChu = htmlspecialchars(strip_tags($this->ghiChu));


            // bind data
            $stmt->bindParam(":maChamDiemRenLuyen", $this->maChamDiemRenLuyen);
            $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
            $stmt->bindParam(":maTieuChi3", $this->maTieuChi3);
            $stmt->bindParam(":maTieuChi2", $this->maTieuChi2);
            $stmt->bindParam(":diemSinhVienDanhGia", $this->diemSinhVienDanhGia);
            $stmt->bindParam(":maSinhVien", $this->maSinhVien);
            $stmt->bindParam(":diemLopDanhGia", $this->diemLopDanhGia);
            $stmt->bindParam(":ghiChu", $this->ghiChu);


            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        // DELETE
        function deleteChamDiemRenLuyen()
        {
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maChamDiemRenLuyen  = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->maChamDiemRenLuyen = htmlspecialchars(strip_tags($this->maChamDiemRenLuyen));

            $stmt->bindParam(1, $this->maChamDiemRenLuyen);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }


?>