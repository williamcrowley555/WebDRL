<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    include_once '../../phpqrcode/qrcode.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new HoatDongDanhGia($db); //new HoatDongDanhGia object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->maHoatDong = $data->maHoatDong;
                $item->maTieuChi3 = $data->maTieuChi3;
                $item->maTieuChi2 = $data->maTieuChi2;
                $item->maKhoa = $data->maKhoa;
                $item->tenHoatDong = $data->tenHoatDong;
                $item->diemNhanDuoc = $data->diemNhanDuoc;
                $item->diaDiemDienRaHoatDong = $data->diaDiemDienRaHoatDong;
                $item->maQRDiaDiem = qrcode1::create_QRcode($data->url); // link check hoat dong, luu name qrcode
                $item->maHocKyDanhGia = $data->maHocKyDanhGia;
                $item->thoiGianBatDauDiemDanh = $data->thoiGianBatDauDiemDanh;
                $item->thoiGianBatDauHoatDong = $data->thoiGianBatDauHoatDong;
                $item->thoiGianKetThucHoatDong = $data->thoiGianKetThucHoatDong;
    
                if($item->createHoatDongDanhGia()){
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "Tạo hoạt động đánh giá thành công!")
                    );
                } else{
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "Tạo hoạt động đánh giá KHÔNG thành công!")
                    );
                }
            }else{
                http_response_code(500);
                echo json_encode(
                    array("message" => "Không có dữ liệu gửi lên!")
                );
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