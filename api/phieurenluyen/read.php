<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/phieurenluyen.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';


$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

//get domain dùng cho link file
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
else $url = "http://";   

$url .= $_SERVER['HTTP_HOST'];   


// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1 ) {

    //if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {
        if (isset($_GET['maPhieuRenLuyen'])) {
            $GET_maPhieuRenLuyen = $_GET['maPhieuRenLuyen'];
        } else {
            $GET_maPhieuRenLuyen = null;
        }

        if (isset($_GET['maLop'])) {
            $GET_maLop = $_GET['maLop'];
        } else {
            $GET_maLop = null;
        }

        if (isset($_GET['maHocKyDanhGia'])) {
            $GET_maHocKyDanhGia = $_GET['maHocKyDanhGia'];
        } else {
            $GET_maHocKyDanhGia = null;
        }

        if (isset($_GET['maSinhVien'])) {
            $GET_maSinhVien = $_GET['maSinhVien'];
        } else {
            $GET_maSinhVien = null;
        }

        if (isset($_GET['maKhoa_quyen'])) {
            $maKhoa_quyen = $_GET['maKhoa_quyen'];
        } else {
            $maKhoa_quyen = null;
        }

        $database = new Database();
        $db = $database->getConnection();

        if ($GET_maSinhVien != null){
            $items = new PhieuRenLuyen($db);
            $stmt = $items->getAllPhieuRenLuyen_TheoMSSV($GET_maSinhVien);
            $itemCount = $stmt->rowCount();


            if ($itemCount > 0) {
                $phieurenluyenArr = array();
                $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
                $phieurenluyenArr["itemCount"] = $itemCount;

                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/upload/";

                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    // if ($fileDinhKem != null){
                    //     $e = array(
                    //         "soThuTu" => $countRow,
                    //         "maPhieuRenLuyen" => $maPhieuRenLuyen,
                    //         "xepLoai" => $xepLoai,
                    //         "diemTongCong" => $diemTongCong,
                    //         "maSinhVien" => $maSinhVien,
                    //         "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                    //         "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                    //         "maHocKyDanhGia" => $maHocKyDanhGia,
                    //         "coVanDuyet" => $coVanDuyet,
                    //         "khoaDuyet" => $khoaDuyet,
                    //         "fileDinhKem" => $urlFile.$maHocKyDanhGia."/".$maSinhVien.'/'.$fileDinhKem
                    //     );
                    //     array_push($phieurenluyenArr["phieurenluyen"], $e);
                    // }else{
                        $e = array(
                            "soThuTu" => $countRow,
                            "maPhieuRenLuyen" => $maPhieuRenLuyen,
                            "xepLoai" => $xepLoai,
                            "diemTongCong" => $diemTongCong,
                            "maSinhVien" => $maSinhVien,
                            "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                            "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                            "maHocKyDanhGia" => $maHocKyDanhGia,
                            "coVanDuyet" => $coVanDuyet,
                            "khoaDuyet" => $khoaDuyet
                            //"fileDinhKem" => $fileDinhKem
                        );
                        array_push($phieurenluyenArr["phieurenluyen"], $e);
                    //}
                    
                }
                http_response_code(200);
                echo json_encode($phieurenluyenArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else if ($GET_maPhieuRenLuyen != null) {
            $items = new PhieuRenLuyen($db);

            if ($maKhoa_quyen == null) {
                $stmt = $items->getPhieuRenLuyen_TheoMaPhieuRenLuyen($GET_maPhieuRenLuyen, false);
            } else {
                $stmt = $items->getPhieuRenLuyen_TheoMaPhieuRenLuyenVaMaKhoa($GET_maPhieuRenLuyen, $maKhoa_quyen, false);
            }
            
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $phieurenluyenArr = array();
                $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
                $phieurenluyenArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/upload/";
    
                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maPhieuRenLuyen" => $maPhieuRenLuyen,
                        "xepLoai" => $xepLoai,
                        "diemTongCong" => $diemTongCong,
                        "maSinhVien" => $maSinhVien,
                        "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                        "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "coVanDuyet" => $coVanDuyet,
                        "khoaDuyet" => $khoaDuyet
                        //"fileDinhKem" => $fileDinhKem
                    );
                    array_push($phieurenluyenArr["phieurenluyen"], $e);
                }
                http_response_code(200);
                echo json_encode($phieurenluyenArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else if ($GET_maLop != null && $GET_maHocKyDanhGia != null) {
            $items = new PhieuRenLuyen($db);
            $stmt = $items->getAllPhieuRenLuyen_TheoMaLopVaMaHKDG($GET_maLop, $GET_maHocKyDanhGia);
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $phieurenluyenArr = array();
                $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
                $phieurenluyenArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/upload/";
    
                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maPhieuRenLuyen" => $maPhieuRenLuyen,
                        "xepLoai" => $xepLoai,
                        "diemTongCong" => $diemTongCong,
                        "maSinhVien" => $maSinhVien,
                        "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                        "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "coVanDuyet" => $coVanDuyet,
                        "khoaDuyet" => $khoaDuyet
                        //"fileDinhKem" => $fileDinhKem
                    );
                    array_push($phieurenluyenArr["phieurenluyen"], $e);
                }
                http_response_code(200);
                echo json_encode($phieurenluyenArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else {
            $items = new PhieuRenLuyen($db);
            $stmt = $items->getAllPhieuRenLuyen();
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $phieurenluyenArr = array();
                $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
                $phieurenluyenArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/upload/";
    
                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    // if ($fileDinhKem != null){
                    //     $e = array(
                    //         "soThuTu" => $countRow,
                    //         "maPhieuRenLuyen" => $maPhieuRenLuyen,
                    //         "xepLoai" => $xepLoai,
                    //         "diemTongCong" => $diemTongCong,
                    //         "maSinhVien" => $maSinhVien,
                    //         "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                    //         "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                    //         "maHocKyDanhGia" => $maHocKyDanhGia,
                    //         "coVanDuyet" => $coVanDuyet,
                    //         "khoaDuyet" => $khoaDuyet,
                    //         "fileDinhKem" => $urlFile.$maHocKyDanhGia."/".$maSinhVien.'/'.$fileDinhKem
                    //     );
                    //     array_push($phieurenluyenArr["phieurenluyen"], $e);
                    // }else{
                        $e = array(
                            "soThuTu" => $countRow,
                            "maPhieuRenLuyen" => $maPhieuRenLuyen,
                            "xepLoai" => $xepLoai,
                            "diemTongCong" => $diemTongCong,
                            "maSinhVien" => $maSinhVien,
                            "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                            "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                            "maHocKyDanhGia" => $maHocKyDanhGia,
                            "coVanDuyet" => $coVanDuyet,
                            "khoaDuyet" => $khoaDuyet
                            //"fileDinhKem" => $fileDinhKem
                        );
                        array_push($phieurenluyenArr["phieurenluyen"], $e);
                    //}
                    
                }
                http_response_code(200);
                echo json_encode($phieurenluyenArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        }
} else {
    http_response_code(403);
    echo json_encode(
        array("message" => "Vui lòng đăng nhập trước!")
    );
}


?>

