<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/thamgiahoatdong.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
        

        if (isset($_GET['maSinhVienThamGia'])){
            $maSinhVienThamGia = isset($_GET['maSinhVienThamGia']) ? $_GET['maSinhVienThamGia'] : die();

            $database = new Database();
            $db = $database->getConnection();

            $items = new ThamGiaHoatDong($db);
            $stmt = $items->getAllThamGiaHoatDong_MaSinhVien($maSinhVienThamGia);
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $thamgiahoatdongArr = array();
                $thamgiahoatdongArr["thamgiahoatdong"] = array(); //tạo object json 
                $thamgiahoatdongArr["itemCount"] = $itemCount;
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                     $countRow++;
                        $e = array(
                        "soThuTu" => $countRow,
                        "maThamGiaHoatDong" => $maThamGiaHoatDong,
                        "maHoatDong" => $maHoatDong,
                        "maSinhVienThamGia" => $maSinhVienThamGia
                    );
                    array_push($thamgiahoatdongArr["thamgiahoatdong"], $e);
                }
                http_response_code(200);
                echo json_encode($thamgiahoatdongArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }


        }else{
            $database = new Database();
            $db = $database->getConnection();

            $items = new ThamGiaHoatDong($db);
            $stmt = $items->getAllThamGiaHoatDong();
            $itemCount = $stmt->rowCount();


            if ($itemCount > 0) {
                $thamgiahoatdongArr = array();
                $thamgiahoatdongArr["thamgiahoatdong"] = array(); //tạo object json 
                $thamgiahoatdongArr["itemCount"] = $itemCount;
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                     $countRow++;
                        $e = array(
                        "soThuTu" => $countRow,
                        "maThamGiaHoatDong" => $maThamGiaHoatDong,
                        "maHoatDong" => $maHoatDong,
                        "maSinhVienThamGia" => $maSinhVienThamGia
                    );
                    array_push($thamgiahoatdongArr["thamgiahoatdong"], $e);
                }
                echo json_encode($thamgiahoatdongArr);
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
} else {
    http_response_code(403);
    echo json_encode(
        array("message" => "Vui lòng đăng nhập trước!")
    );
}
?>