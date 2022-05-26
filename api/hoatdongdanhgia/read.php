<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $database = new Database();
    $db = $database->getConnection();

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    //get domain dùng cho link file
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
    else $url = "http://";   

    $url .= $_SERVER['HTTP_HOST'];  

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
       
        $items = new HoatDongDanhGia($db);
        $stmt = $items->getAllHoatDongDanhGia();
        $itemCount = $stmt->rowCount();


        if($itemCount > 0){
            $hoatdongdanhgiaArr = array();
            $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
            $hoatdongdanhgiaArr["itemCount"] = $itemCount;

            $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";

            $countRow = 0;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $countRow++;
                $e = array(
                    "soThuTu" => $countRow,
                    "maHoatDong" => $maHoatDong ,
                    "maTieuChi3" => $maTieuChi3,
                    "maTieuChi2" => $maTieuChi2,
                    "maKhoa" => $maKhoa,
                    "tenHoatDong" => $tenHoatDong,
                    "diemNhanDuoc" => $diemNhanDuoc,
                    "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                    "maQRDiaDiem" => $urlFile.$maQRDiaDiem,
                    "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                    "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong
                );
                array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
            }
            http_response_code(200);
            echo json_encode($hoatdongdanhgiaArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "Không tìm thấy dữ liệu.")
            );
        }
       
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
?>