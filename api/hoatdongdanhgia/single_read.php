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

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    //get domain dùng cho link file
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
        else $url = "http://";   
        
    $url .= $_SERVER['HTTP_HOST'];

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        
        //if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {
        
            $database = new Database();
            $db = $database->getConnection();
            $item = new HoatDongDanhGia($db);

            $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";
        
            $item->maHoatDong = isset($_GET['maHoatDong']) ? $_GET['maHoatDong'] : die(); //Lấy id từ phương thức GET
        
            $item->getSingleHoatDongDanhGia();
            if($item->maTieuChi3 != null){
                $temp_ThoiGianBatDauHoatDong = new DateTime($item->thoiGianBatDauHoatDong);
                $temp_ThoiGianKetThucHoatDong = new DateTime($item->thoiGianKetThucHoatDong);

                // create array
                $hoatdongdanhgia_arr = array(
                    "maHoatDong" =>  $item->maHoatDong,
                    "maTieuChi3" => $item->maTieuChi3,
                    "maTieuChi2" => $item->maTieuChi2,
                    "maKhoa" => $item->maKhoa,
                    "tenHoatDong" =>  $item->tenHoatDong,
                    "diemNhanDuoc" => $item->diemNhanDuoc,
                    "maHocKyDanhGia" => $item->maHocKyDanhGia,
                    "thoiGianBatDauDiemDanh" => $item->thoiGianBatDauDiemDanh,
                    "diaDiemDienRaHoatDong" => $item->diaDiemDienRaHoatDong,
                    "maQRDiaDiem" =>  $urlFile.$item->maQRDiaDiem,
                    "thoiGianBatDauHoatDong" =>  $temp_ThoiGianBatDauHoatDong->format('Y-m-d\TH:i'),
                    "thoiGianKetThucHoatDong" =>  $temp_ThoiGianKetThucHoatDong->format('Y-m-d\TH:i')
                );
            
                http_response_code(200);
                echo json_encode($hoatdongdanhgia_arr);
            }
            
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "hoatdongdanhgia không tìm thấy!")
                );
           
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