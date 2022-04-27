<?php
    class UserToken{
        // Connection
        private $conn;
        // Table
        private $db_table = "user_token";
        // Columns
        public $maSo;
        public $token;
        public $quyen;
        public $thoiGianDangNhap;
        public $thoiGianHetHan;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllUserToken(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleUserToken(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ."
                        WHERE maSo = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maSo);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maSo = $dataRow['maSo'];
                $this->token = $dataRow['token'];
                $this->quyen = $dataRow['quyen'];
                $this->thoiGianDangNhap = $dataRow['thoiGianDangNhap'];
                $this->thoiGianHetHan = $dataRow['thoiGianHetHan'];
            }
            
        }

        public function checkUserTokenExist($maSo){
            $sqlQuery = "SELECT * FROM ". $this->db_table ."
                        WHERE maSo = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $maSo);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                return true;
            }
            
            return false;
        }

        // CREATE
        public function createUserToken(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maSo = :maSo, 
                        token = :token,
                        quyen = :quyen, 
                        thoiGianDangNhap = :thoiGianDangNhap,
                        thoiGianHetHan = :thoiGianHetHan";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maSo=htmlspecialchars(strip_tags($this->maSo));
            $this->token=htmlspecialchars(strip_tags($this->token));
            $this->quyen=htmlspecialchars(strip_tags($this->quyen));
            $this->thoiGianDangNhap=htmlspecialchars(strip_tags($this->thoiGianDangNhap));
            $this->thoiGianHetHan=htmlspecialchars(strip_tags($this->thoiGianHetHan));
        
            // bind data
            $stmt->bindParam(":maSo", $this->maSo);
            $stmt->bindParam(":token", $this->token);
            $stmt->bindParam(":quyen", $this->quyen);
            $stmt->bindParam(":thoiGianDangNhap", $this->thoiGianDangNhap);
            $stmt->bindParam(":thoiGianHetHan", $this->thoiGianHetHan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateUserToken(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        maSo = :maSo, 
                        token = :token,
                        quyen = :quyen, 
                        thoiGianDangNhap = :thoiGianDangNhap,
                        thoiGianHetHan = :thoiGianHetHan
                    WHERE 
                        maSo = :maSo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maSo=htmlspecialchars(strip_tags($this->maSo));
            $this->token=htmlspecialchars(strip_tags($this->token));
            $this->quyen=htmlspecialchars(strip_tags($this->quyen));
            $this->thoiGianDangNhap=htmlspecialchars(strip_tags($this->thoiGianDangNhap));
            $this->thoiGianHetHan=htmlspecialchars(strip_tags($this->thoiGianHetHan));
        
            // bind data
            $stmt->bindParam(":maSo", $this->maSo);
            $stmt->bindParam(":token", $this->token);
            $stmt->bindParam(":quyen", $this->quyen);
            $stmt->bindParam(":thoiGianDangNhap", $this->thoiGianDangNhap);
            $stmt->bindParam(":thoiGianHetHan", $this->thoiGianHetHan);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUserToken(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maSo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maSo=htmlspecialchars(strip_tags($this->maSo));
        
            $stmt->bindParam(1, $this->maSo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>