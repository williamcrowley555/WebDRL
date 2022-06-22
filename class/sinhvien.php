<?php
class SinhVien
{
    // Connection
    private $conn;
    // Table
    private $db_table = "sinhvien";
    // Columns
    public $maSinhVien;
    public $hoTenSinhVien;
    public $ngaySinh;
    public $he;
    public $matKhauSinhVien;
    public $maLop;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //-------------------
    //Các chức năng

    //GET ALL NO PAGING
    public function getAllSinhVienNoPaging()
    {

        $sqlQuery = "SELECT maSinhVien, hoTenSinhVien, ngaySinh, he, maLop FROM " . $this->db_table . "";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL
    public function getAllSinhVien()
    {
        if (@$_GET['page'] && @$_GET['row_per_page']) {
            $page = $_GET['page'];
            $row_per_page = $_GET['row_per_page'];

            $begin = ($page * $row_per_page) - $row_per_page;

            $sqlQuery = "SELECT maSinhVien, hoTenSinhVien, ngaySinh, he, maLop FROM " . $this->db_table . " LIMIT " . $begin . "," . $row_per_page . "";
        } else {
            $sqlQuery = "SELECT maSinhVien, hoTenSinhVien, ngaySinh, he, maLop FROM " . $this->db_table . "";
        }

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL SINHVIEN THEO MALOP
    public function getAllSinhVienTheoMaLop($maLop)
    {
        $sqlQuery = "SELECT maSinhVien, hoTenSinhVien, ngaySinh, he, maLop FROM " . $this->db_table . " 
                        WHERE maLop = ? ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maLop);
        $stmt->execute();
        return $stmt;
    }


    // READ single
    public function getSingleSinhVien()
    {
        $sqlQuery = "SELECT maSinhVien , hoTenSinhVien, ngaySinh, he, matKhauSinhVien, maLop FROM " . $this->db_table . "
                        WHERE maSinhVien  = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->maSinhVien);
        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow != null) {
            $this->maSinhVien  = $dataRow['maSinhVien'];
            $this->hoTenSinhVien = $dataRow['hoTenSinhVien'];
            $this->ngaySinh = $dataRow['ngaySinh'];
            $this->he = $dataRow['he'];
            $this->matKhauSinhVien = $dataRow['matKhauSinhVien'];
            $this->maLop = $dataRow['maLop'];
        }
    }

    // CREATE
    public function createSinhVien()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        maSinhVien = :maSinhVien, 
                        hoTenSinhVien = :hoTenSinhVien, 
                        ngaySinh = :ngaySinh, 
                        he = :he,
                        matKhauSinhVien = :matKhauSinhVien,
                        maLop = :maLop";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->matKhauSinhVien = htmlspecialchars(strip_tags($this->matKhauSinhVien));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));

        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":matKhauSinhVien", $this->matKhauSinhVien);
        $stmt->bindParam(":maLop", $this->maLop);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateSinhVien()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        hoTenSinhVien = :hoTenSinhVien, 
                        ngaySinh = :ngaySinh, 
                        he = :he,
                        matKhauSinhVien = :matKhauSinhVien,
                        maLop = :maLop
                    WHERE 
                        maSinhVien  = :maSinhVien ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->matKhauSinhVien = htmlspecialchars(strip_tags($this->matKhauSinhVien));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));


        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":matKhauSinhVien", $this->matKhauSinhVien);
        $stmt->bindParam(":maLop", $this->maLop);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateSinhVien_KhongMatKhau()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        hoTenSinhVien = :hoTenSinhVien, 
                        ngaySinh = :ngaySinh, 
                        he = :he,
                        maLop = :maLop
                    WHERE 
                        maSinhVien  = :maSinhVien ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));


        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":maLop", $this->maLop);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteSinhVien()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maSinhVien  = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));

        $stmt->bindParam(1, $this->maSinhVien);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // check login 
    //  public function check_login(){
    //     $sqlQuery = "SELECT maSinhVien , hoTenSinhVien, ngaySinh, he, matKhauSinhVien, maLop FROM ". $this->db_table ."
    //                 WHERE maSinhVien = ? AND matKhauSinhVien = ? LIMIT 0,1";
    //     $stmt = $this->conn->prepare($sqlQuery);
    //     $stmt->bindParam(1, $this->maSinhVien);
    //     $stmt->bindParam(2, $this->matKhauSinhVien);
    //     $stmt->execute();

    //     $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($dataRow != null){
    //         $this->maSinhVien  = $dataRow['maSinhVien'];
    //         $this->hoTenSinhVien = $dataRow['hoTenSinhVien'];
    //         $this->ngaySinh = $dataRow['ngaySinh'];
    //         $this->he = $dataRow['he'];
    //         $this->maLop = $dataRow['maLop'];

    //         return true;
    //     }

    //     return false;

    // }

}
