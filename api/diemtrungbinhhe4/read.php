<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../../class/diemtrungbinhhe4.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV($data["user_data"]->aud)) {

        if (isset($_GET['maSinhVien'])) {
            $maSinhVien = $_GET['maSinhVien'];
        } else {
            $maSinhVien = null;
        }
        
        $database = new Database();
        $db = $database->getConnection();

        if($maSinhVien != null) {
            $items = new DiemTrungBinhHe4($db);
            $stmt = $items->getAllDiemTrungBinhHe4TheoMaSinhVien($maSinhVien);
            $itemCount = $stmt->rowCount();

            if ($itemCount > 0) {

                $diemtrungbinhhe4Arr = array();
                $diemtrungbinhhe4Arr["diemtrungbinhhe4"] = array(); //tạo object json 
                $diemtrungbinhhe4Arr["itemCount"] = $itemCount;

                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "diem" => $diem,
                        "maDiemTrungBinh" => $maDiemTrungBinh,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "maSinhVien" => $maSinhVien,
                    );
                    
                    array_push($diemtrungbinhhe4Arr["diemtrungbinhhe4"], $e);
                };
                
                http_response_code(200);
                echo json_encode($diemtrungbinhhe4Arr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        }
    }
}
?>