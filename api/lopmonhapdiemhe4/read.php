<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/lopmonhapdiemhe4.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$database = new Database();
$db = $database->getConnection();

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {

        if (isset($_GET['maLop'])) {
            $GET_maLop = $_GET['maLop'];
        } else {
            $GET_maLop = null;
        }

        if (isset($_GET['maHocKyMo'])) {
            $GET_maHocKyMo = $_GET['maHocKyMo'];
        } else {
            $GET_maHocKyMo = null;
        }

        if ($GET_maLop != null && $GET_maHocKyMo != null) {
            $items = new LopMoNhapDiemHe4($db);
        
            $stmt = $items->getAllLopTheoMaLopVaMaHocKyMo($GET_maLop, $GET_maHocKyMo);
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $lopArr = array();
                $lopArr["lopmonhapdiemhe4"] = array(); //tạo object json 
                $lopArr["itemCount"] = $itemCount;
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maLop" => $maLop,
                        "maHocKyMo" => $maHocKyMo
                    );
                    array_push($lopArr["lopmonhapdiemhe4"], $e);
                }
                http_response_code(200);
                echo json_encode($lopArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else if($GET_maLop != null) {
            $items = new LopMoNhapDiemHe4($db);
        
            $stmt = $items->getAllLopTheoMaLop($GET_maLop);
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $lopArr = array();
                $lopArr["lopmonhapdiemhe4"] = array(); //tạo object json 
                $lopArr["itemCount"] = $itemCount;
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maLop" => $maLop,
                        "maHocKyMo" => $maHocKyMo
                    );
                    array_push($lopArr["lopmonhapdiemhe4"], $e);
                }
                http_response_code(200);
                echo json_encode($lopArr);
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