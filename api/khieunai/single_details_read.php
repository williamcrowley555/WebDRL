<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khieunai.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            
            if (isset($_GET['maKhieuNai'])) {
                $GET_maKhieuNai = $_GET['maKhieuNai'];
            } else {
                $GET_maKhieuNai = null;
            }
            
            $database = new Database();
            $db = $database->getConnection();
            
            if($GET_maKhieuNai != null) {
                $item = new KhieuNai($db);
            
                $item->getSingleDetailsTheoMaKhieuNai($GET_maKhieuNai);
                if($item->maPhieuRenLuyen != null) {
                    // create array
                    $khieuNai_arr = array(
                        "maKhieuNai" =>  $item->maKhieuNai,
                        "maPhieuRenLuyen" => $item->maPhieuRenLuyen,
                        "lyDoKhieuNai" => $item->lyDoKhieuNai,
                        "minhChung" => $item->minhChung,
                        "trangThai" => $item->trangThai,
                        "thoiGianKhieuNai" => $item->thoiGianKhieuNai,
                        "loiNhan" => $item->loiNhan,
                        "lyDoTuChoi" => $item->lyDoTuChoi,
                        "maHocKyDanhGia" => $item->maHocKyDanhGia,
                        "maSinhVien" => $item->maSinhVien,
                        "hoTenSinhVien" => $item->hoTenSinhVien,
                        "maLop" => $item->maLop,
                    );
                
                    http_response_code(200);
                    echo json_encode($khieuNai_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                }
            }
        } else {
                http_response_code(403);
                echo json_encode(
                    array("message" => "Bạn không có quyền thực hiện điều này!")
                );
        }
       
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
    
?>