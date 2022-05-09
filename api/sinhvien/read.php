<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../../class/sinhvien.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();

$quyen = "";

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {



        $database = new Database();
        $db = $database->getConnection();

        $items = new SinhVien($db);
        $stmt = $items->getAllSinhVien();
        $itemCount = $stmt->rowCount();

        $totalRecords = $items->getAllSinhVienNoPaging()->rowCount();


        //echo json_encode($itemCount); //print itemCount
        if ($itemCount > 0) {
            $sinhvienArr = array();
            $sinhvienArr["sinhvien"] = array(); //tạo object json 
            $sinhvienArr["itemCount"] = $itemCount;
            $sinhvienArr["totalRecords"] = $totalRecords;

            $countRow = 0;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $countRow++;
                $e = array(
                    "soThuTu" => $countRow,
                    "maSinhVien" => $maSinhVien,
                    "hoTenSinhVien" => $hoTenSinhVien,
                    "ngaySinh" => $ngaySinh,
                    "he" => $he,
                    "maLop" => $maLop
                );
                array_push($sinhvienArr["sinhvien"], $e);
            }
            http_response_code(200);
            echo json_encode($sinhvienArr);
        } else {
            http_response_code(404);
            echo json_encode(
                array("message" => "Không tìm thấy kết quả.")
            );
        }
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
