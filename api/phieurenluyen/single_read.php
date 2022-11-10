<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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


// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();
        $item = new PhieuRenLuyen($db);
        
        $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/upload/";

        if (isset($_GET['maPhieuRenLuyen'])){
            $item->maPhieuRenLuyen = isset($_GET['maPhieuRenLuyen']) ? $_GET['maPhieuRenLuyen'] : die(); //Lấy id từ phương thức GET

            $item->getSinglePhieuRenLuyen();
            if ($item->maPhieuRenLuyen != null) {

                // if ($item->fileDinhKem != null){
                //     // create array
                //     $phieurenluyen_arr = array(
                //         "maPhieuRenLuyen" =>  $item->maPhieuRenLuyen,
                //         "xepLoai" => $item->xepLoai,
                //         "diemTongCong" => $item->diemTongCong,
                //         "maSinhVien" => $item->maSinhVien,
                //         "diemTrungBinhChungHKTruoc" => $item->diemTrungBinhChungHKTruoc,
                //         "diemTrungBinhChungHKXet" => $item->diemTrungBinhChungHKXet,
                //         "maHocKyDanhGia" => $item->maHocKyDanhGia,
                //         "coVanDuyet" => $item->coVanDuyet,
                //         "khoaDuyet" => $item->khoaDuyet,
                //         "fileDinhKem" => $urlFile.$item->maHocKyDanhGia."/".$item->maSinhVien.'/'.$item->fileDinhKem
                //     );

                //     http_response_code(200);
                //     echo json_encode($phieurenluyen_arr);
                // }else{
                    // create array
                    $phieurenluyen_arr = array(
                        "maPhieuRenLuyen" =>  $item->maPhieuRenLuyen,
                        "xepLoai" => $item->xepLoai,
                        "diemTongCong" => $item->diemTongCong,
                        "maSinhVien" => $item->maSinhVien,
                        "diemTrungBinhChungHKTruoc" => $item->diemTrungBinhChungHKTruoc,
                        "diemTrungBinhChungHKXet" => $item->diemTrungBinhChungHKXet,
                        "maHocKyDanhGia" => $item->maHocKyDanhGia,
                        "coVanDuyet" => $item->coVanDuyet,
                        "khoaDuyet" => $item->khoaDuyet
                        //"fileDinhKem" => $item->fileDinhKem
                    );

                    http_response_code(200);
                    echo json_encode($phieurenluyen_arr);
                //}
                
            } else {
                http_response_code(404);
                echo json_encode("phieurenluyen không tìm thấy.");
            }
        }else{
            if (isset($_GET['maHocKyDanhGia']) && isset($_GET['maSinhVien']) ){
                $item->maHocKyDanhGia = isset($_GET['maHocKyDanhGia']) ? $_GET['maHocKyDanhGia'] : die(); //Lấy id từ phương thức GET
                $item->maSinhVien = isset($_GET['maSinhVien']) ? $_GET['maSinhVien'] : die();
        
                $item->getSinglePhieuRenLuyen_TheoMaHocKyVaMSSV();
                if ($item->maPhieuRenLuyen != null) {
                    // create array
                    // if ($item->fileDinhKem != null){
                    //     // create array
                    //     $phieurenluyen_arr = array(
                    //         "maPhieuRenLuyen" =>  $item->maPhieuRenLuyen,
                    //         "xepLoai" => $item->xepLoai,
                    //         "diemTongCong" => $item->diemTongCong,
                    //         "maSinhVien" => $item->maSinhVien,
                    //         "diemTrungBinhChungHKTruoc" => $item->diemTrungBinhChungHKTruoc,
                    //         "diemTrungBinhChungHKXet" => $item->diemTrungBinhChungHKXet,
                    //         "maHocKyDanhGia" => $item->maHocKyDanhGia,
                    //         "coVanDuyet" => $item->coVanDuyet,
                    //         "khoaDuyet" => $item->khoaDuyet,
                    //         "fileDinhKem" => $urlFile.$item->maHocKyDanhGia."/".$item->maSinhVien.'/'.$item->fileDinhKem
                    //     );
    
                    //     http_response_code(200);
                    //     echo json_encode($phieurenluyen_arr);
                    // }else{
                        // create array
                        $phieurenluyen_arr = array(
                            "maPhieuRenLuyen" =>  $item->maPhieuRenLuyen,
                            "xepLoai" => $item->xepLoai,
                            "diemTongCong" => $item->diemTongCong,
                            "maSinhVien" => $item->maSinhVien,
                            "diemTrungBinhChungHKTruoc" => $item->diemTrungBinhChungHKTruoc,
                            "diemTrungBinhChungHKXet" => $item->diemTrungBinhChungHKXet,
                            "maHocKyDanhGia" => $item->maHocKyDanhGia,
                            "coVanDuyet" => $item->coVanDuyet,
                            "khoaDuyet" => $item->khoaDuyet
                            //"fileDinhKem" => $item->fileDinhKem
                        );
    
                        http_response_code(200);
                        echo json_encode($phieurenluyen_arr);
                    //}
                } else {
                
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "phieurenluyen không tìm thấy!")
                    );
                }
            }

            
        }
        
    // } else {
    //     http_response_code(403);
    //     echo json_encode(
    //         array("message" => "Bạn không có quyền thực hiện điều này!")
    //     );
    // }
} else {
    http_response_code(403);
    echo json_encode(
        array("message" => "Vui lòng đăng nhập trước!")
    );
}



?>


