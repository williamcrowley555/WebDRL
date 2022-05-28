<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/thamgiahoatdong.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
            $item = new ThamGiaHoatDong($db);

            if (isset($_GET["maThamGiaHoatDong"])){
                $item->maThamGiaHoatDong = isset($_GET['maThamGiaHoatDong']) ? $_GET['maThamGiaHoatDong'] : die(); //Lấy id từ phương thức GET
        
                $item->getSingleThamGiaHoatDong();
                if($item->maHoatDong != null){
                    // create array
                    $thamgiahoatdong_arr = array(
                        "maThamGiaHoatDong" =>  $item->maThamGiaHoatDong,
                        "maHoatDong" => $item->maHoatDong,
                        "maSinhVienThamGia" => $item->maSinhVienThamGia
                    );
                
                    http_response_code(200);
                    echo json_encode($thamgiahoatdong_arr);
                }else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                }
            }else{
                if (isset($_GET["maSinhVienThamGia"]) && isset($_GET["maHoatDong"])){
                    $item->maSinhVienThamGia = isset($_GET['maSinhVienThamGia']) ? $_GET['maSinhVienThamGia'] : die(); //Lấy id từ phương thức GET
                    $item->maHoatDong = isset($_GET['maHoatDong']) ? $_GET['maHoatDong'] : die(); //Lấy id từ phương thức GET

                    $item->getSingleThamGiaHoatDong_MaHoatDongVaMaSinhVien();
                    if($item->maHoatDong != null){
                        // create array
                        $thamgiahoatdong_arr = array(
                            "maThamGiaHoatDong" =>  $item->maThamGiaHoatDong,
                            "maHoatDong" => $item->maHoatDong,
                            "maSinhVienThamGia" => $item->maSinhVienThamGia
                        );
                    
                        http_response_code(200);
                        echo json_encode($thamgiahoatdong_arr);
                    }else{
                        http_response_code(404);
                        echo json_encode(
                            array("message" => "Không tìm thấy dữ liệu.")
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