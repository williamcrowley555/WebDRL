<?php
    class PhongCongTacSinhVien{
        // Connection
        private $conn;
        // Table
        private $db_table = "phongcongtacsinhvien";
        // Columns
        public $taiKhoan;
        public $matKhau;
        public $hoTenNhanVien;
        public $email;
        public $sdt;
        public $diaChi;
        public $quyen;
        public $kichHoat;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllPhongCTSV(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAllPhongCTSVBySearchText($searchText) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE taiKhoan LIKE '%$searchText%' " .
                            "OR hoTenNhanVien LIKE '%$searchText%' " .
                            "OR email LIKE '%$searchText%' " .
                            "OR sodienthoai LIKE '%$searchText%' ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getPhongCTSVTheoTaiKhoan($taiKhoan, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE taiKhoan" . 
                            ($isEqual ? " = '$taiKhoan'" : " LIKE '%$taiKhoan%'");
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getPhongCTSVTheoEmail($email, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE email" . 
                            ($isEqual ? " = '$email'" : " LIKE '%$email%'");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getPhongCTSVTheoSdt($sodienthoai, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE sodienthoai" . 
                            ($isEqual ? " = '$sodienthoai'" : " LIKE '%$sodienthoai%'");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createPhongCTSV(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        taiKhoan = :taiKhoan, 
                        matKhau = :matKhau,
                        hoTenNhanVien = :hoTenNhanVien,
                        email = :email,
                        sodienthoai = :sodienthoai,
                        quyen = :quyen,
                        diaChi = :diaChi,
                        kichHoat = :kichHoat";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTenNhanVien=htmlspecialchars(strip_tags($this->hoTenNhanVien));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->sodienthoai=htmlspecialchars(strip_tags($this->sodienthoai));
            $this->quyen=htmlspecialchars(strip_tags($this->quyen));
            $this->diaChi=htmlspecialchars(strip_tags($this->diaChi));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTenNhanVien", $this->hoTenNhanVien);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":sodienthoai", $this->sodienthoai);
            $stmt->bindParam(":quyen", $this->quyen);
            $stmt->bindParam(":diaChi", $this->diaChi);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updatePhongCTSV(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        hoTenNhanVien = :hoTenNhanVien,
                        email = :email,
                        sodienthoai = :sodienthoai
                    WHERE 
                        taiKhoan = :taiKhoan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->hoTenNhanVien=htmlspecialchars(strip_tags($this->hoTenNhanVien));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->sodienthoai=htmlspecialchars(strip_tags($this->sodienthoai));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":hoTenNhanVien", $this->hoTenNhanVien);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":sodienthoai", $this->sodienthoai);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updatePhongCTSV_MatKhau() {
            $sqlQuery = "UPDATE
                            " . $this->db_table . "
                        SET
                            matKhau = :matKhau
                        WHERE 
                            taiKhoan  = :taiKhoan ";

            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan = htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau = htmlspecialchars(strip_tags($this->matKhau));

            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function updatePhongCTSV_KichHoat(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        kichHoat = :kichHoat
                    WHERE 
                        taiKhoan = :taiKhoan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePhongCTSV(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE taiKhoan = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
        
            $stmt->bindParam(1, $this->taiKhoan);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

?>