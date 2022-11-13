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

        public function getAllAdminBySearchText($searchText) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE taiKhoan LIKE '%$searchText%' " .
                            "OR hoTen LIKE '%$searchText%' " .
                            "OR email LIKE '%$searchText%' " .
                            "OR soDienThoai LIKE '%$searchText%' ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAdminTheoId($id, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE id" . 
                            ($isEqual ? " = '$id'" : " LIKE '%$id%'");
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAdminTheoTaiKhoan($taiKhoan, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE taiKhoan" . 
                            ($isEqual ? " = '$taiKhoan'" : " LIKE '%$taiKhoan%'");
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAdminTheoEmail($email, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE email" . 
                            ($isEqual ? " = '$email'" : " LIKE '%$email%'");

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getAdminTheoSdt($soDienThoai, $isEqual = true) {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                            WHERE soDienThoai" . 
                            ($isEqual ? " = '$soDienThoai'" : " LIKE '%$soDienThoai%'");

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
                        quyen = :quyen,
                        kichHoat = :kichHoat";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->matKhau=htmlspecialchars(strip_tags($this->matKhau));
            $this->hoTen=htmlspecialchars(strip_tags($this->hoTen));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
            $this->quyen=htmlspecialchars(strip_tags($this->quyen));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":matKhau", $this->matKhau);
            $stmt->bindParam(":hoTen", $this->hoTen);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
            $stmt->bindParam(":quyen", $this->quyen);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateAdmin(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        hoTen = :hoTen,
                        email = :email,
                        soDienThoai = :soDienThoai
                    WHERE 
                        taiKhoan = :taiKhoan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->taiKhoan=htmlspecialchars(strip_tags($this->taiKhoan));
            $this->hoTen=htmlspecialchars(strip_tags($this->hoTen));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->soDienThoai=htmlspecialchars(strip_tags($this->soDienThoai));
        
            // bind data
            $stmt->bindParam(":taiKhoan", $this->taiKhoan);
            $stmt->bindParam(":hoTen", $this->hoTen);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":soDienThoai", $this->soDienThoai);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updateAdmin_MatKhau() {
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

        public function updateAdmin_KichHoat(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        kichHoat = :kichHoat
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":id", $this->id);
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