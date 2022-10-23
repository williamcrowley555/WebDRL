<?php
class PhieuRenLuyen
{
    // Connection
    private $conn;
    // Table
    private $db_table = "phieurenluyen";
    // Columns
    public $maPhieuRenLuyen; //
    public $xepLoai;
    public $diemTongCong;
    public $maSinhVien;
    public $diemTrungBinhChungHKTruoc;
    public $diemTrungBinhChungHKXet;
    public $maHocKyDanhGia;
    public $coVanDuyet;
    public $khoaDuyet;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //-------------------
    //Các chức năng

    // GET ALL
    public function getAllPhieuRenLuyen()
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL THEO MA LOP
    public function getAllPhieuRenLuyen_TheoMaLop($maLop)
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, sinhvien.maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet 
                        FROM " . $this->db_table . ", sinhvien 
                        WHERE phieurenluyen.maSinhVien = sinhvien.maSinhVien AND maLop = ? 
                        ORDER BY maHocKyDanhGia DESC";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maLop);
        $stmt->execute();
        return $stmt;
    }

    // GET ALL THEO MSSV
    public function getAllPhieuRenLuyen_TheoMSSV($maSinhVien)
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet FROM " . $this->db_table . "
                        WHERE maSinhVien = ? 
                        ORDER BY maHocKyDanhGia DESC";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $maSinhVien);
        $stmt->execute();
        return $stmt;
    }

    // GET PHIEU REN LUYEN THEO MA PHIEU REN LUYEN
    public function getPhieuRenLuyen_TheoMaPhieuRenLuyen($maPhieuRenLuyen, $isEqual = true)
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet FROM " . $this->db_table . "
                        WHERE maPhieuRenLuyen" . 
                        ($isEqual ? " = '$maPhieuRenLuyen'" : " LIKE '%$maPhieuRenLuyen%'") . 
                        " ORDER BY maHocKyDanhGia DESC";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // READ single
    public function getSinglePhieuRenLuyen()
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet FROM " . $this->db_table . "
                        WHERE maPhieuRenLuyen = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->maPhieuRenLuyen);
        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow != null) {
            $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
            $this->xepLoai = $dataRow['xepLoai'];
            $this->diemTongCong = $dataRow['diemTongCong'];
            $this->maSinhVien = $dataRow['maSinhVien'];
            $this->diemTrungBinhChungHKTruoc = $dataRow['diemTrungBinhChungHKTruoc'];
            $this->diemTrungBinhChungHKXet = $dataRow['diemTrungBinhChungHKXet'];
            $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
            $this->coVanDuyet = $dataRow['coVanDuyet'];
            $this->khoaDuyet = $dataRow['khoaDuyet'];
        }
    }

    public function getSinglePhieuRenLuyen_TheoMaHocKyVaMSSV()
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia, coVanDuyet, khoaDuyet FROM " . $this->db_table . "
                        WHERE maHocKyDanhGia = ? AND maSinhVien = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->maHocKyDanhGia);
        $stmt->bindParam(2, $this->maSinhVien);
        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow != null) {
            $this->maPhieuRenLuyen = $dataRow['maPhieuRenLuyen'];
            $this->xepLoai = $dataRow['xepLoai'];
            $this->diemTongCong = $dataRow['diemTongCong'];
            $this->maSinhVien = $dataRow['maSinhVien'];
            $this->diemTrungBinhChungHKTruoc = $dataRow['diemTrungBinhChungHKTruoc'];
            $this->diemTrungBinhChungHKXet = $dataRow['diemTrungBinhChungHKXet'];
            $this->maHocKyDanhGia = $dataRow['maHocKyDanhGia'];
            $this->coVanDuyet = $dataRow['coVanDuyet'];
            $this->khoaDuyet = $dataRow['khoaDuyet'];
        }
    }
    
    // CREATE
    public function createPhieuRenLuyen()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        maPhieuRenLuyen = :maPhieuRenLuyen,
                        xepLoai = :xepLoai, 
                        diemTongCong = :diemTongCong, 
                        maSinhVien = :maSinhVien,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc, 
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet,
                        coVanDuyet = :coVanDuyet,
                        khoaDuyet = :khoaDuyet,
                        maHocKyDanhGia = :maHocKyDanhGia";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
        $this->xepLoai = htmlspecialchars(strip_tags($this->xepLoai));
        $this->diemTongCong = htmlspecialchars(strip_tags($this->diemTongCong));
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->diemTrungBinhChungHKTruoc = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
        $this->diemTrungBinhChungHKXet = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        $this->maHocKyDanhGia = htmlspecialchars(strip_tags($this->maHocKyDanhGia));
        $this->coVanDuyet = htmlspecialchars(strip_tags($this->coVanDuyet));
        $this->khoaDuyet = htmlspecialchars(strip_tags($this->khoaDuyet));

        // bind data
        $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
        $stmt->bindParam(":xepLoai", $this->xepLoai);
        $stmt->bindParam(":diemTongCong", $this->diemTongCong);
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
        $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
        $stmt->bindParam(":coVanDuyet", $this->coVanDuyet);
        $stmt->bindParam(":khoaDuyet", $this->khoaDuyet);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // UPDATE
    public function updatePhieuRenLuyen()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        xepLoai = :xepLoai, 
                        diemTongCong = :diemTongCong, 
                        maSinhVien = :maSinhVien,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc, 
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet,
                        maHocKyDanhGia = :maHocKyDanhGia,
                        coVanDuyet = :coVanDuyet,
                        khoaDuyet = :khoaDuyet
                    WHERE 
                        maPhieuRenLuyen = :maPhieuRenLuyen";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
        $this->xepLoai = htmlspecialchars(strip_tags($this->xepLoai));
        $this->diemTongCong = htmlspecialchars(strip_tags($this->diemTongCong));
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->diemTrungBinhChungHKTruoc = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
        $this->diemTrungBinhChungHKXet = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        $this->maHocKyDanhGia = htmlspecialchars(strip_tags($this->maHocKyDanhGia));
        $this->coVanDuyet = htmlspecialchars(strip_tags($this->coVanDuyet));
        $this->khoaDuyet = htmlspecialchars(strip_tags($this->khoaDuyet));
       
        // bind data
        $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
        $stmt->bindParam(":xepLoai", $this->xepLoai);
        $stmt->bindParam(":diemTongCong", $this->diemTongCong);
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
        $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
        $stmt->bindParam(":coVanDuyet", $this->coVanDuyet);
        $stmt->bindParam(":khoaDuyet", $this->khoaDuyet);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    // UPDATE WITH FILE
    public function updatePhieuRenLuyen_WithFile()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        xepLoai = :xepLoai, 
                        diemTongCong = :diemTongCong, 
                        maSinhVien = :maSinhVien,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc, 
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet,
                        maHocKyDanhGia = :maHocKyDanhGia,
                        coVanDuyet = :coVanDuyet,
                        khoaDuyet = :khoaDuyet
                    WHERE 
                        maPhieuRenLuyen = :maPhieuRenLuyen";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));
        $this->xepLoai = htmlspecialchars(strip_tags($this->xepLoai));
        $this->diemTongCong = htmlspecialchars(strip_tags($this->diemTongCong));
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->diemTrungBinhChungHKTruoc = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
        $this->diemTrungBinhChungHKXet = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        $this->maHocKyDanhGia = htmlspecialchars(strip_tags($this->maHocKyDanhGia));
        $this->coVanDuyet = htmlspecialchars(strip_tags($this->coVanDuyet));
        $this->khoaDuyet = htmlspecialchars(strip_tags($this->khoaDuyet));
       
        // bind data
        $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
        $stmt->bindParam(":xepLoai", $this->xepLoai);
        $stmt->bindParam(":diemTongCong", $this->diemTongCong);
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
        $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);
        $stmt->bindParam(":coVanDuyet", $this->coVanDuyet);
        $stmt->bindParam(":khoaDuyet", $this->khoaDuyet);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deletePhieuRenLuyen()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE maPhieuRenLuyen = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->maPhieuRenLuyen = htmlspecialchars(strip_tags($this->maPhieuRenLuyen));

        $stmt->bindParam(1, $this->maPhieuRenLuyen);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
