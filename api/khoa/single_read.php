<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khoa.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            if (isset($_GET['maKhoa'])) {
                $maKhoa = $_GET['maKhoa'];
            } else {
                $maKhoa = null;
            }

            if (isset($_GET['taiKhoanKhoa'])) {
                $taiKhoanKhoa = $_GET['taiKhoanKhoa'];
            } else {
                $taiKhoanKhoa = null;
            }

            if ($maKhoa != null) {
                $database = new Database();
                $db = $database->getConnection();
                $item = new Khoa($db);
                $item->maKhoa = $maKhoa;
            
                $item->getSingleKhoa();
                if($item->tenKhoa != null) {
                    // create array
                    $khoa_arr = array(
                        "maKhoa" =>  $item->maKhoa,
                        "tenKhoa" => $item->tenKhoa,
                        "taiKhoanKhoa" => $item->taiKhoanKhoa
                        //"matKhauKhoa" => $item->matKhauKhoa
                    );
                
                    http_response_code(200);
                    echo json_encode($khoa_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                }
            } else if ($taiKhoanKhoa != null) {
                $database = new Database();
                $db = $database->getConnection();
                $item = new Khoa($db);
                $item->taiKhoanKhoa = $taiKhoanKhoa;
            
                $item->getSingleKhoaTheoTaiKhoan();
                if($item->tenKhoa != null) {
                    // create array
                    $khoa_arr = array(
                        "maKhoa" =>  $item->maKhoa,
                        "tenKhoa" => $item->tenKhoa,
                        "taiKhoanKhoa" => $item->taiKhoanKhoa
                        //"matKhauKhoa" => $item->matKhauKhoa
                    );
                
                    http_response_code(200);
                    echo json_encode($khoa_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
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