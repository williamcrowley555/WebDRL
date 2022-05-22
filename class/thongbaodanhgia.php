<?php
    class ThongBaoDanhGia{
        // Connection
        private $conn;
        // Table
        private $db_table = "thongbaodanhgia";
        // Columns
        public $maThongBao ;
        public $ngaySinhVienDanhGia;
        public $ngaySinhVienKetThucDanhGia;
        public $ngayCoVanDanhGia;
        public $ngayCoVanKetThucDanhGia;
        public $ngayKhoaDanhGia;
        public $ngayKhoaKetThucDanhGia;
        public $ngayThongBao;
        public $maHocKyDanhGia;


        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllThongBaoDanhGia(){
            $sqlQuery = "SELECT maThongBao   , ngaySinhVienDanhGia, ngaySinhVienKetThucDanhGia, ngayCoVanDanhGia, ngayCoVanKetThucDanhGia, ngayKhoaDanhGia, ngayKhoaKetThucDanhGia, ngayThongBao, maHocKyDanhGia FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleThongBaoDanhGia(){
            $sqlQuery = "SELECT maThongBao   , ngaySinhVienDanhGia, ngaySinhVienKetThucDanhGia, ngayCoVanDanhGia, ngayCoVanKetThucDanhGia, ngayKhoaDanhGia, ngayKhoaKetThucDanhGia, ngayThongBao, maHocKyDanhGia FROM ". $this->db_table ."
                        WHERE maThongBao    = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maThongBao   );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maThongBao    = $dataRow['maThongBao   '];
                $this->ngaySinhVienDanhGia = $dataRow['ngaySinhVienDanhGia'];
                $this->ngaySinhVienKetThucDanhGia = $dataRow['ngaySinhVienKetThucDanhGia'];
                $this->ngayCoVanDanhGia = $dataRow['ngayCoVanDanhGia'];
                $this->ngayCoVanKetThucDanhGia = $dataRow['ngayCoVanKetThucDanhGia'];
                $this->ngayKhoaDanhGia = $dataRow['ngayKhoaDanhGia'];
                $this->ngayKhoaKetThucDanhGia = $dataRow['ngayKhoaKetThucDanhGia'];
                $this->ngayThongBao = $dataRow['ngayThongBao'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
            }
            
        }

        //Get single thongbao qua maHocKyDanhGia
        public function getSingleThongBaoDanhGia_HocKyDanhGia(){
            $sqlQuery = "SELECT maThongBao, ngaySinhVienDanhGia, ngaySinhVienKetThucDanhGia, ngayCoVanDanhGia, ngayCoVanKetThucDanhGia, ngayKhoaDanhGia, ngayKhoaKetThucDanhGia, ngayThongBao, maHocKyDanhGia FROM ". $this->db_table ."
                        WHERE maHocKyDanhGia = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maHocKyDanhGia  );
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maThongBao   = $dataRow['maThongBao'];
                $this->ngaySinhVienDanhGia = $dataRow['ngaySinhVienDanhGia'];
                $this->ngaySinhVienKetThucDanhGia = $dataRow['ngaySinhVienKetThucDanhGia'];
                $this->ngayCoVanDanhGia = $dataRow['ngayCoVanDanhGia'];
                $this->ngayCoVanKetThucDanhGia = $dataRow['ngayCoVanKetThucDanhGia'];
                $this->ngayKhoaDanhGia = $dataRow['ngayKhoaDanhGia'];
                $this->ngayKhoaKetThucDanhGia = $dataRow['ngayKhoaKetThucDanhGia'];
                $this->ngayThongBao = $dataRow['ngayThongBao'];
                $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
            }
            
        }

        // CREATE
        public function createThongBaoDanhGia(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        ngaySinhVienDanhGia = :ngaySinhVienDanhGia, 
                        ngaySinhVienKetThucDanhGia = :ngaySinhVienKetThucDanhGia, 
                        ngayCoVanDanhGia = :ngayCoVanDanhGia,
                        ngayCoVanKetThucDanhGia = :ngayCoVanKetThucDanhGia,
                        ngayKhoaDanhGia = :ngayKhoaDanhGia,
                        ngayKhoaKetThucDanhGia = :ngayKhoaKetThucDanhGia,
                        ngayThongBao = :ngayThongBao,
                        maHocKyDanhGia = :maHocKyDanhGia";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->ngaySinhVienDanhGia=htmlspecialchars(strip_tags($this->ngaySinhVienDanhGia));
            $this->ngaySinhVienKetThucDanhGia=htmlspecialchars(strip_tags($this->ngaySinhVienKetThucDanhGia));
            $this->ngayCoVanDanhGia=htmlspecialchars(strip_tags($this->ngayCoVanDanhGia));
            $this->ngayCoVanKetThucDanhGia=htmlspecialchars(strip_tags($this->ngayCoVanKetThucDanhGia));
            $this->ngayKhoaDanhGia=htmlspecialchars(strip_tags($this->ngayKhoaDanhGia));
            $this->ngayKhoaKetThucDanhGia=htmlspecialchars(strip_tags($this->ngayKhoaKetThucDanhGia));
            $this->ngayThongBao=htmlspecialchars(strip_tags($this->ngayThongBao));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
        
            // bind data
            $stmt->bindParam(":ngaySinhVienDanhGia", $this->ngaySinhVienDanhGia);
            $stmt->bindParam(":ngaySinhVienKetThucDanhGia", $this->ngaySinhVienKetThucDanhGia);
            $stmt->bindParam(":ngayCoVanDanhGia", $this->ngayCoVanDanhGia);
            $stmt->bindParam(":ngayCoVanKetThucDanhGia", $this->ngayCoVanKetThucDanhGia);
            $stmt->bindParam(":ngayKhoaDanhGia", $this->ngayKhoaDanhGia);
            $stmt->bindParam(":ngayKhoaKetThucDanhGia", $this->ngayKhoaKetThucDanhGia);
            $stmt->bindParam(":ngayThongBao", $this->ngayThongBao);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateThongBaoDanhGia(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        ngaySinhVienDanhGia = :ngaySinhVienDanhGia, 
                        ngaySinhVienKetThucDanhGia = :ngaySinhVienKetThucDanhGia, 
                        ngayCoVanDanhGia = :ngayCoVanDanhGia,
                        ngayCoVanKetThucDanhGia = :ngayCoVanKetThucDanhGia,
                        ngayKhoaDanhGia = :ngayKhoaDanhGia,
                        ngayKhoaKetThucDanhGia = :ngayKhoaKetThucDanhGia,
                        ngayThongBao = :ngayThongBao,
                        maHocKyDanhGia = :maHocKyDanhGia
                    WHERE 
                        maThongBao    = :maThongBao   ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maThongBao   =htmlspecialchars(strip_tags($this->maThongBao   ));
            $this->ngaySinhVienDanhGia=htmlspecialchars(strip_tags($this->ngaySinhVienDanhGia));
            $this->ngaySinhVienKetThucDanhGia=htmlspecialchars(strip_tags($this->ngaySinhVienKetThucDanhGia));
            $this->ngayCoVanDanhGia=htmlspecialchars(strip_tags($this->ngayCoVanDanhGia));
            $this->ngayCoVanKetThucDanhGia=htmlspecialchars(strip_tags($this->ngayCoVanKetThucDanhGia));
            $this->ngayKhoaDanhGia=htmlspecialchars(strip_tags($this->ngayKhoaDanhGia));
            $this->ngayKhoaKetThucDanhGia=htmlspecialchars(strip_tags($this->ngayKhoaKetThucDanhGia));
            $this->ngayThongBao=htmlspecialchars(strip_tags($this->ngayThongBao));
            $this->maHocKyDanhGia=htmlspecialchars(strip_tags($this->maHocKyDanhGia));
        
        
            // bind data
            $stmt->bindParam(":maThongBao   ", $this->maThongBao   );
            $stmt->bindParam(":ngaySinhVienDanhGia", $this->ngaySinhVienDanhGia);
            $stmt->bindParam(":ngaySinhVienKetThucDanhGia", $this->ngaySinhVienKetThucDanhGia);
            $stmt->bindParam(":ngayCoVanDanhGia", $this->ngayCoVanDanhGia);
            $stmt->bindParam(":ngayCoVanKetThucDanhGia", $this->ngayCoVanKetThucDanhGia);
            $stmt->bindParam(":ngayKhoaDanhGia", $this->ngayKhoaDanhGia);
            $stmt->bindParam(":ngayKhoaKetThucDanhGia", $this->ngayKhoaKetThucDanhGia);
            $stmt->bindParam(":ngayThongBao", $this->ngayThongBao);
            $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteThongBaoDanhGia(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maThongBao    = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maThongBao   =htmlspecialchars(strip_tags($this->maThongBao   ));
        
            $stmt->bindParam(1, $this->maThongBao   );
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>