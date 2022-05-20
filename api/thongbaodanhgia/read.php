<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/thongbaodanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();

    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        //if ($checkQuyen->checkQuyen_Khoa_CTSV($data["user_data"]->aud)){
            $database = new Database();
            $db = $database->getConnection();
    
            $items = new ThongBaoDanhGia($db);
            $stmt = $items->getAllThongBaoDanhGia();
            $itemCount = $stmt->rowCount();
    
    
            if($itemCount > 0){
                $thongbaodanhgiaArr = array();
                $thongbaodanhgiaArr["thongbaodanhgia"] = array(); //tạo object json 
                $thongbaodanhgiaArr["itemCount"] = $itemCount;
    
                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maThongBao " => $maThongBao ,
                        "ngaySinhVienDanhGia" => $ngaySinhVienDanhGia,
                        "ngaySinhVienKetThucDanhGia" => $ngaySinhVienKetThucDanhGia,
                        "ngayCoVanDanhGia" => $ngayCoVanDanhGia,
                        "ngayCoVanKetThucDanhGia" => $ngayCoVanKetThucDanhGia,
                        "ngayKhoaDanhGia" => $ngayKhoaDanhGia,
                        "ngayKhoaKetThucDanhGia" => $ngayKhoaKetThucDanhGia,
                        "ngayThongBao" => $ngayThongBao,
                        "maHocKyDanhGia" => $maHocKyDanhGia
                    );
                    array_push($thongbaodanhgiaArr["thongbaodanhgia"], $e);
                }
                http_response_code(200);
                echo json_encode($thongbaodanhgiaArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        // }else{
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }
        
    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>