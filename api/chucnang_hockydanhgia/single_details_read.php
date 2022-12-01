<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/chucnang_hockydanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        // if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {

            if (isset($_GET['maChucNang'])) {
                $maChucNang = $_GET['maChucNang'];
            } else {
                $maChucNang = null;
            }

            if (isset($_GET['maHocKyDanhGia'])) {
                $maHocKyDanhGia = $_GET['maHocKyDanhGia'];
            } else {
                $maHocKyDanhGia = null;
            }

            if ($maChucNang != null && $maHocKyDanhGia != null) {
                $database = new Database();
                $db = $database->getConnection();
        
                $items = new ChucNang_HocKyDanhGia($db);
                $stmt = $items->getSingleDetailsTheoMaChucNangVaMaHKDG($maChucNang, $maHocKyDanhGia);
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    extract($row);

                    // create array
                    $chucNang_HocKyDanhGiaArr = array(
                        "maChucNang" => $maChucNang,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "ghiChu" => $ghiChu,
                        "hocKyXet" => $hocKyXet,
                        "namHocXet" => $namHocXet
                    );

                    http_response_code(200);
                    echo json_encode($chucNang_HocKyDanhGiaArr);
            
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
            }
        // } else {
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }
    }else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>