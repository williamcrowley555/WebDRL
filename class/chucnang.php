<?php
    class ChucNang{
        // Connection
        private $conn;
        // Table
        private $db_table = "chucnang";
        // Columns
        public $maChucNang;
        public $tenChucNang;
        public $kichHoat;
        public $moTa;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllChucNang(){
            $sqlQuery = "SELECT * FROM " . $this->db_table;
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        
        // READ single
        public function getSingleChucNang(){
            $sqlQuery = "SELECT * FROM " . $this->db_table .
                        " WHERE maChucNang = ? 
                        LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->maChucNang);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->maChucNang = $dataRow['maChucNang'];
                $this->tenChucNang = $dataRow['tenChucNang'];
                $this->kichHoat = $dataRow['kichHoat'];
                $this->moTa = $dataRow['moTa'];
            }
        }

        // CREATE
        public function createChucNang(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        maChucNang = :maChucNang,
                        tenChucNang = :tenChucNang, 
                        kichHoat = :kichHoat, 
                        moTa = :moTa";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
            $this->tenChucNang=htmlspecialchars(strip_tags($this->tenChucNang));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
            $this->moTa=htmlspecialchars(strip_tags($this->moTa));
        
            // bind data
            $stmt->bindParam(":maChucNang", $this->maChucNang);
            $stmt->bindParam(":tenChucNang", $this->tenChucNang);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
            $stmt->bindParam(":moTa", $this->moTa);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateChucNang(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        tenChucNang = :tenChucNang, 
                        kichHoat = :kichHoat, 
                        moTa = :moTa
                    WHERE 
                        maChucNang = :maChucNang";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
            $this->tenChucNang=htmlspecialchars(strip_tags($this->tenChucNang));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
            $this->moTa=htmlspecialchars(strip_tags($this->moTa));
        
            // bind data
            $stmt->bindParam(":maChucNang", $this->maChucNang);
            $stmt->bindParam(":tenChucNang", $this->tenChucNang);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
            $stmt->bindParam(":moTa", $this->moTa);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE kichHoat
        public function updateKichHoat(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        kichHoat = :kichHoat
                    WHERE 
                        maChucNang = :maChucNang";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
            $this->kichHoat=htmlspecialchars(strip_tags($this->kichHoat));
        
            // bind data
            $stmt->bindParam(":maChucNang", $this->maChucNang);
            $stmt->bindParam(":kichHoat", $this->kichHoat);
        
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteChucNang(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maChucNang = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->maChucNang=htmlspecialchars(strip_tags($this->maChucNang));
        
            $stmt->bindParam(1, $this->maChucNang);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>