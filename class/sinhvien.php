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

        $sqlQuery = "SELECT * FROM " . $this->db_table . "";

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

            $sqlQuery = "SELECT * FROM " . $this->db_table . " LIMIT " . $begin . "," . $row_per_page . "";
        } else {
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        }

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL THEO MAKHOA & MALOP
    public function getAllSinhVienTheoMaKhoaVaMaLop($maKhoa, $maLop)
    {
        $sqlQuery = "SELECT sinhvien.* 
                            FROM sinhvien LEFT JOIN lop ON sinhvien.maLop = lop.maLop 
                            WHERE maKhoa = ? AND sinhvien.maLop = ?";


        if (@$_GET['page'] && @$_GET['row_per_page']) {
            $page = $_GET['page'];
            $row_per_page = $_GET['row_per_page'];

            $begin = ($page * $row_per_page) - $row_per_page;

            $sqlQuery .= " LIMIT " . $begin . "," . $row_per_page . "";
        }

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maKhoa);
        $stmt->bindParam(2, $maLop);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL THEO MAKHOA 
    public function getAllSinhVienTheoMaKhoa($maKhoa)
    {
        $sqlQuery = "SELECT sinhvien.* 
                        FROM sinhvien LEFT JOIN lop ON sinhvien.maLop = lop.maLop 
                        WHERE maKhoa = ?";
                            

        if (@$_GET['page'] && @$_GET['row_per_page']) {
            $page = $_GET['page'];
            $row_per_page = $_GET['row_per_page'];

            $begin = ($page * $row_per_page) - $row_per_page;

            $sqlQuery .= " LIMIT " . $begin . "," . $row_per_page . "";
        }

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maKhoa);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL SINHVIEN THEO MALOP
    public function getAllSinhVienTheoMaLop($maLop)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maLop = ? ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maLop);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL SINHVIEN CO EMAIL
    public function getAllSinhVienWithEmail($totNghiep = false)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . 
                    " WHERE email IS NOT NULL" .
                    ($totNghiep ? " AND totNghiep = 1" : "");

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET SINHVIEN THEO MA SO SINH VIEN
    public function getSinhVienTheoMSSV($mssv, $isEqual = true)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maSinhVien" . 
                        ($isEqual ? " = '$mssv'" : " LIKE '%$mssv%'");

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET SINHVIEN DETAISL THEO MA SO SINH VIEN
    public function getSinhVienDetailsTheoMSSV($mssv)
    {
        $sqlQuery = "SELECT sinhvien.*, lop.*, tenKhoa 
                    FROM sinhvien, lop, khoa
                    WHERE sinhvien.maLop = lop.maLop 
                        AND lop.maKhoa = khoa.maKhoa
                        AND maSinhVien = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $mssv);
        $stmt->execute();
        return $stmt;
    }

    // READ single
    public function getSingleSinhVien()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "
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

    // GET SINGLE SINHVIEN THEO MA SO SINH VIEN
    public function getSingleinhVienTheoMSSVVaMatKhau($mssv, $matKhau)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " 
                        WHERE maSinhVien = ? AND matKhauSinhVien = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $mssv);
        $stmt->bindParam(2, $matKhau);
        $stmt->execute();
        return $stmt;
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
                        email = :email,
                        sdt = :sdt,
                        he = :he,
                        matKhauSinhVien = :matKhauSinhVien,
                        maLop = :maLop,
                        totNghiep = :totNghiep";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->sdt = htmlspecialchars(strip_tags($this->sdt));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->matKhauSinhVien = htmlspecialchars(strip_tags($this->matKhauSinhVien));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));
        $this->totNghiep = htmlspecialchars(strip_tags($this->totNghiep));

        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":sdt", $this->sdt);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":matKhauSinhVien", $this->matKhauSinhVien);
        $stmt->bindParam(":maLop", $this->maLop);
        $stmt->bindParam(":totNghiep", $this->totNghiep);

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
                        email = :email, 
                        sdt = :sdt, 
                        he = :he,
                        matKhauSinhVien = :matKhauSinhVien,
                        maLop = :maLop,
                        totNghiep = :totNghiep

                    WHERE 
                        maSinhVien  = :maSinhVien ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->sdt = htmlspecialchars(strip_tags($this->sdt));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->matKhauSinhVien = htmlspecialchars(strip_tags($this->matKhauSinhVien));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));
        $this->totNghiep = htmlspecialchars(strip_tags($this->totNghiep));


        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":sdt", $this->sdt);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":matKhauSinhVien", $this->matKhauSinhVien);
        $stmt->bindParam(":maLop", $this->maLop);
        $stmt->bindParam(":totNghiep", $this->totNghiep);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updateSinhVien_MatKhau()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        matKhauSinhVien = :matKhauSinhVien
                    WHERE 
                        maSinhVien  = :maSinhVien ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->matKhauSinhVien = htmlspecialchars(strip_tags($this->matKhauSinhVien));


        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":matKhauSinhVien", $this->matKhauSinhVien);

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
                        email = :email, 
                        sdt = :sdt, 
                        he = :he,
                        maLop = :maLop,
                        totNghiep = :totNghiep
                    WHERE 
                        maSinhVien  = :maSinhVien ";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->hoTenSinhVien = htmlspecialchars(strip_tags($this->hoTenSinhVien));
        $this->ngaySinh = htmlspecialchars(strip_tags($this->ngaySinh));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->sdt = htmlspecialchars(strip_tags($this->sdt));
        $this->he = htmlspecialchars(strip_tags($this->he));
        $this->maLop = htmlspecialchars(strip_tags($this->maLop));
        $this->totNghiep = htmlspecialchars(strip_tags($this->totNghiep));

        // bind data
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":hoTenSinhVien", $this->hoTenSinhVien);
        $stmt->bindParam(":ngaySinh", $this->ngaySinh);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":sdt", $this->sdt);
        $stmt->bindParam(":he", $this->he);
        $stmt->bindParam(":maLop", $this->maLop);
        $stmt->bindParam(":totNghiep", $this->totNghiep);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateTaiKhoanSinhVien() {
        if(isset($this->maSinhVien)) {
            $sqlQuery = "UPDATE " . $this->db_table;
        
            if(isset($this->maSinhVien) && (isset($this->email) || isset($this->sdt) || isset($this->anhDaiDien))) {
                $sqlQuery.= " SET ".
                                (isset($this->email) ? "email = :email, " : "").
                                (isset($this->sdt) ? "sdt = :sdt, " : "").
                                (isset($this->anhDaiDien) ? "anhDaiDien = :anhDaiDien, " : "");
                $sqlQuery = substr($sqlQuery, 0, -2);
                $sqlQuery.= " WHERE maSinhVien = :maSinhVien";

                $stmt = $this->conn->prepare($sqlQuery);

                // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
                if(isset($this->email))
                    $this->email = htmlspecialchars(strip_tags($this->email));
                if(isset($this->sdt))
                    $this->sdt = htmlspecialchars(strip_tags($this->sdt));
                if(isset($this->anhDaiDien))
                    $this->anhDaiDien = htmlspecialchars(strip_tags($this->anhDaiDien));
                if(isset($this->maSinhVien))
                    $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));

                // bind data
                if(isset($this->email))
                    $stmt->bindParam(":email", $this->email);
                if(isset($this->sdt))
                    $stmt->bindParam(":sdt", $this->sdt);
                if(isset($this->anhDaiDien))
                    $stmt->bindParam(":anhDaiDien", $this->anhDaiDien);
                if(isset($this->maSinhVien))
                    $stmt->bindParam(":maSinhVien", $this->maSinhVien);

                if ($stmt->execute()) {
                    return true;
                }
            }
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
