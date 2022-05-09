<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        $database = new Database();
        $db = $database->getConnection();

        $items = new HoatDongDanhGia($db);
        $stmt = $items->getAllHoatDongDanhGia();
        $itemCount = $stmt->rowCount();


        echo json_encode($itemCount); //print itemCount
        if($itemCount > 0){
            $hoatdongdanhgiaArr = array();
            $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
            $hoatdongdanhgiaArr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "maHoatDong" => $maHoatDong ,
                    "maTieuChi3" => $maTieuChi3,
                    "maTieuChi2" => $maTieuChi2,
                    "maKhoa" => $maKhoa,
                    "tenHoatDong" => $tenHoatDong,
                    "diemNhanDuoc" => $diemNhanDuoc,
                    "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                    "maQRDiaDiem" => $maQRDiaDiem,
                    "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                    "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong
                );
                array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
            }
            echo json_encode($hoatdongdanhgiaArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
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