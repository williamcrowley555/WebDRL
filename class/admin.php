<?php
    class Admin{
        // Connection
        private $conn;
        // Table
        private $db_table = "admin";
        // Columns
        public $taiKhoan;
        public $matKhau;
        public $hoTen;
        public $email;
        public $soDienThoai;
        public $quyen;
        public $kichHoat;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllAdmin(){
            $sqlQuery = "SELECT * FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createAdmin(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        taiKhoan = :taiKhoan, 
                        matKhau = :matKhau,
                        hoTen = :hoTen,
                        email = :email,
                        soDienThoai = :soDienThoai,
                        kichHoat = :kichHoat";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTen=htmlspecialchars(strip_tags($this->hoTen));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTen", $this->hoTen);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
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
                        taiKhoan = :taiKhoan, 
                        matKhau = :matKhau,
                        hoTen = :hoTen,
                        email = :email,
                        soDienThoai = :soDienThoai,
                        kichHoat = :kichHoat
                    WHERE 
                        taiKhoan = :taiKhoan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTen=htmlspecialchars(strip_tags($this->hoTen));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTen", $this->hoTen);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
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