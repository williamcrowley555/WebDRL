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

    // kiểm tra đăng nhập thành công 
    if ($data["status"] == 1) {
        //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();

            $item = new PhieuRenLuyen($db); //new Khoa object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 


                if (isset($_POST['maPhieuRenLuyen']) && isset($_POST['maSinhVien']) &&
                    isset($_POST['diemTrungBinhChungHKTruoc']) && isset($_POST['diemTrungBinhChungHKXet']) 
                    && isset($_POST['maHocKyDanhGia']) && isset($_POST['diemTongCong'])){

                    //set các biến bằng data nhận từ user
                    $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
                    $item->xepLoai = $_POST['xepLoai'];
                    $item->diemTongCong = $_POST['diemTongCong'];
                    $item->maSinhVien = $_POST['maSinhVien'];
                    $item->diemTrungBinhChungHKTruoc = $_POST['diemTrungBinhChungHKTruoc'];
                    $item->diemTrungBinhChungHKXet = $_POST['diemTrungBinhChungHKXet'];
                    $item->maHocKyDanhGia = $_POST['maHocKyDanhGia'];
                    $item->coVanDuyet = null;
                    $item->khoaDuyet = null;
          
                        
                    if ($item->createPhieuRenLuyen()) {
                        http_response_code(200);
                        echo json_encode(array(
                            "message"=>"phieurenluyen tạo thành công."
                        ));
                    } else {
                        http_response_code(404);
                        echo json_encode(array(
                            "message"=>"phieurenluyen tạo KHÔNG thành công."
                        ));
                    }
        
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không có dữ liệu được gửi lên!")
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
