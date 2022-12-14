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

        if (isset($_GET['maSinhVien'])) {
            $GET_maSinhVien = $_GET['maSinhVien'];
        } else {
            $GET_maSinhVien = null;
        }

        $database = new Database();
        $db = $database->getConnection();

        if ($GET_maSinhVien != null){
            $items = new PhieuRenLuyen($db);
            $stmt = $items->getAllPhieuRenLuyenDetails_TheoMSSV($GET_maSinhVien);
            $itemCount = $stmt->rowCount();


            if ($itemCount > 0) {
                $phieurenluyenArr = array();
                $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
                $phieurenluyenArr["itemCount"] = $itemCount;

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
                            "khoaDuyet" => $khoaDuyet,
                            "namHocXet" => $namHocXet,
                            "hocKyXet" => $hocKyXet
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

