<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/admin.php';
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
        if (isset($_GET['searchText'])) {
            $items = new Admin($db);
            $stmt = $items->getAllAdminBySearchText($_GET['searchText']);
            $itemCount = $stmt->rowCount();

            $countRow = 0;

            if ($itemCount > 0) {
                $adminArr = array();
                $adminArr["admin"] = array(); //tạo object json 
                $adminArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "id" => $id,
                        "taiKhoan" => $taiKhoan,
                        "hoTen" => $hoTen,
                        "email" => $email,
                        "soDienThoai" => $soDienThoai,
                        "quyen" => $quyen,
                        "kichHoat" => $kichHoat,
                        "matKhau" => $matKhau
                    );
                    array_push($adminArr["admin"], $e);
                }
                http_response_code(200);
                echo json_encode($adminArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else {
            $items = new Admin($db);
            $stmt = $items->getAllAdmin();
            $itemCount = $stmt->rowCount();

            $countRow = 0;

            if ($itemCount > 0) {
                $adminArr = array();
                $adminArr["admin"] = array(); //tạo object json 
                $adminArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "id" => $id,
                        "taiKhoan" => $taiKhoan,
                        "hoTen" => $hoTen,
                        "email" => $email,
                        "soDienThoai" => $soDienThoai,
                        "quyen" => $quyen,
                        "kichHoat" => $kichHoat,
                        "matKhau" => $matKhau
                    );
                    array_push($adminArr["admin"], $e);
                }
                http_response_code(200);
                echo json_encode($adminArr);
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
