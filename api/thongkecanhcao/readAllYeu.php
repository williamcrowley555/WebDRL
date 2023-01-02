<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/thongkecanhcao.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$database = new Database();
$db = $database->getConnection();

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)) {

        if (isset($_GET['maKhoa'])) {
            $GET_maKhoa = $_GET['maKhoa'];
        } else {
            $GET_maKhoa = null;
        }

        if ($GET_maKhoa != null) {
            $items = new ThongKeCanhCao($db);
            
            $stmt = $items->getAllSinhVienCoDiemYeu($GET_maKhoa);
            $itemCount = $stmt->rowCount();
            
            if ($itemCount > 0) {
                $thongKe_arr = array();
                $thongKe_arr["sinhvien"] = array(); //tạo object json 
                $thongKe_arr["itemCount"] = $itemCount;
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    
                    $e = array(
                        "soThuTu" => $countRow,
                        "maSinhVien" =>  $maSinhVien,
                        "hoTenSinhVien" => $hoTenSinhVien,
                        "ngaySinh" => $ngaySinh,
                        "he" =>  $he,
                        "email" =>  $email,
                        "sdt" => $sdt,
                        "anhDaiDien" => $anhDaiDien,
                        "totNghiep" => $totNghiep,
                        "maLop" => $maLop,
                        "quyen" => $quyen,
                        "soLanYeu" => $soLanYeu
                    );

                    array_push($thongKe_arr["sinhvien"], $e);
                }
                http_response_code(200);
                echo json_encode($thongKe_arr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
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
?>