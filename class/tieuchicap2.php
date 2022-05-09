<?php
    class Tieuchicap2{
        // Connection
        private $conn;
        // Table
        private $db_table = "tieuchicap2";
        // Columns
        public $matc2;
        public $noidung;
        public $diemtoida;
        public $matc1;
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //-------------------
        //Các chức năng

        // GET ALL
        public function getAllTC2(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // READ single
        public function getSingleTC2(){
            $sqlQuery = "SELECT * FROM ". $this->db_table ."
                        WHERE matc2 = ? LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->matc2);
            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dataRow != null){
                $this->matc2 = $dataRow['matc2'];
                $this->noidung = $dataRow['noidung'];
                $this->diemtoida = $dataRow['diemtoida'];
                $this->matc1 = $dataRow['matc1'];
            }
            
        }

        // CREATE
        public function createTC2(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        noidung = :noidung,
                        diemtoida = :diemtoida,
                        matc1 = :matc1";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diemtoida=htmlspecialchars(strip_tags($this->diemtoida));
            $this->matc1=htmlspecialchars(strip_tags($this->matc1));
        
            // bind data
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diemtoida", $this->diemtoida);
            $stmt->bindParam(":matc1", $this->matc1);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function updateTC2(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        noidung = :noidung, 
                        diemtoida = :diemtoida,
                        matc1 = :matc1, 
                    WHERE 
                        matc2 = :matc2";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
            $this->matc2=htmlspecialchars(strip_tags($this->matc2));
            $this->noidung=htmlspecialchars(strip_tags($this->noidung));
            $this->diemtoida=htmlspecialchars(strip_tags($this->diemtoida));
            $this->matc1=htmlspecialchars(strip_tags($this->matc1));
        
            // bind data
            $stmt->bindParam(":matc2", $this->matc2);
            $stmt->bindParam(":noidung", $this->noidung);
            $stmt->bindParam(":diemtoida", $this->diemtoida);
            $stmt->bindParam(":matc1", $this->matc1);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteTC2(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE matc2 = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->matc2=htmlspecialchars(strip_tags($this->matc2));
        
            $stmt->bindParam(2, $this->matc2);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }


    }

?>