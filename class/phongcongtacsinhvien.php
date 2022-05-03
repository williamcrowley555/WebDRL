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
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllPhongCTSV(){
            $sqlQuery = "SELECT hoTenNhanVien, email, sodienthoai, diaChi FROM " . $this->db_table . "";
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
                        diaChi = :diaChi";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTenNhanVien=htmlspecialchars(strip_tags($this->hoTenNhanVien));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->sodienthoai=htmlspecialchars(strip_tags($this->sodienthoai));
            $this->diaChi=htmlspecialchars(strip_tags($this->diaChi));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTenNhanVien", $this->hoTenNhanVien);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":sodienthoai", $this->sodienthoai);
            $stmt->bindParam(":diaChi", $this->diaChi);
        
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
                    taiKhoan = :taiKhoan, 
                    matKhau = :matKhau,
                    hoTenNhanVien = :hoTenNhanVien,
                    email = :email,
                    sodienthoai = :sodienthoai,
                    diaChi = :diaChi
                    WHERE 
                    taiKhoan = :taiKhoan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTenNhanVien=htmlspecialchars(strip_tags($this->hoTenNhanVien));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->sodienthoai=htmlspecialchars(strip_tags($this->sodienthoai));
            $this->diaChi=htmlspecialchars(strip_tags($this->diaChi));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTenNhanVien", $this->hoTenNhanVien);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":sodienthoai", $this->sodienthoai);
            $stmt->bindParam(":diaChi", $this->diaChi);
        
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