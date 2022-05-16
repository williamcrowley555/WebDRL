<?php
class PhieuRenLuyen
{
    // Connection
    private $conn;
    // Table
    private $db_table = "phieurenluyen";
    // Columns
    public $maPhieuRenLuyen;
    public $xepLoai;
    public $diemTongCong;
    public $maSinhVien;
    public $diemTrungBinhChungHKTruoc;
    public $diemTrungBinhChungHKXet;
    public $maHocKyDanhGia;

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
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // READ single
    public function getSinglePhieuRenLuyen()
    {
        $sqlQuery = "SELECT maPhieuRenLuyen, xepLoai, diemTongCong, maSinhVien, diemTrungBinhChungHKTruoc, diemTrungBinhChungHKXet, maHocKyDanhGia FROM " . $this->db_table . "
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
        }
    }

    // CREATE
    public function createPhieuRenLuyen()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        xepLoai = :xepLoai, 
                        diemTongCong = :diemTongCong, 
                        maSinhVien = :maSinhVien,
                        diemTrungBinhChungHKTruoc = :diemTrungBinhChungHKTruoc, 
                        diemTrungBinhChungHKXet = :diemTrungBinhChungHKXet,
                        maHocKyDanhGia = :maHocKyDanhGia";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize (Lọc dữ liệu đầu vào tránh SQLInjection, XSS)
        $this->xepLoai = htmlspecialchars(strip_tags($this->xepLoai));
        $this->diemTongCong = htmlspecialchars(strip_tags($this->diemTongCong));
        $this->maSinhVien = htmlspecialchars(strip_tags($this->maSinhVien));
        $this->diemTrungBinhChungHKTruoc = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKTruoc));
        $this->diemTrungBinhChungHKXet = htmlspecialchars(strip_tags($this->diemTrungBinhChungHKXet));
        $this->maHocKyDanhGia = htmlspecialchars(strip_tags($this->maHocKyDanhGia));

        // bind data
        $stmt->bindParam(":xepLoai", $this->xepLoai);
        $stmt->bindParam(":diemTongCong", $this->diemTongCong);
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
        $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);

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
                        maHocKyDanhGia = :maHocKyDanhGia
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

        // bind data
        $stmt->bindParam(":maPhieuRenLuyen", $this->maPhieuRenLuyen);
        $stmt->bindParam(":xepLoai", $this->xepLoai);
        $stmt->bindParam(":diemTongCong", $this->diemTongCong);
        $stmt->bindParam(":maSinhVien", $this->maSinhVien);
        $stmt->bindParam(":diemTrungBinhChungHKTruoc", $this->diemTrungBinhChungHKTruoc);
        $stmt->bindParam(":diemTrungBinhChungHKXet", $this->diemTrungBinhChungHKXet);
        $stmt->bindParam(":maHocKyDanhGia", $this->maHocKyDanhGia);


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
