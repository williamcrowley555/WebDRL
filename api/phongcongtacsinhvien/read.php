<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/phongcongtacsinhvien.php';
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
        if(isset($_GET['searchText'])) {
            $items = new PhongCongTacSinhVien($db);
            $stmt = $items->getAllPhongCTSVBySearchText($_GET['searchText']);
            $itemCount = $stmt->rowCount();

            $countRow = 0;

            if ($itemCount > 0) {
                $phongcongtacsinhvienArr = array();
                $phongcongtacsinhvienArr["phongcongtacsinhvien"] = array(); //tạo object json 
                $phongcongtacsinhvienArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "taiKhoan" => $taiKhoan,
                        "hoTenNhanVien" => $hoTenNhanVien,
                        "email" => $email,
                        "sodienthoai" => $sodienthoai,
                        "diaChi" => $diaChi,
                        "quyen" => $quyen,
                        "kichHoat" => $kichHoat,
                        "matKhau" => $matKhau
                    );
                    array_push($phongcongtacsinhvienArr["phongcongtacsinhvien"], $e);
                }
                http_response_code(200);
                echo json_encode($phongcongtacsinhvienArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        } else {
            $items = new PhongCongTacSinhVien($db);
            $stmt = $items->getAllPhongCTSV();
            $itemCount = $stmt->rowCount();

            $countRow = 0;

            if ($itemCount > 0) {
                $phongcongtacsinhvienArr = array();
                $phongcongtacsinhvienArr["phongcongtacsinhvien"] = array(); //tạo object json 
                $phongcongtacsinhvienArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "taiKhoan" => $taiKhoan,
                        "hoTenNhanVien" => $hoTenNhanVien,
                        "email" => $email,
                        "sodienthoai" => $sodienthoai,
                        "diaChi" => $diaChi,
                        "quyen" => $quyen,
                        "kichHoat" => $kichHoat,
                        "matKhau" => $matKhau
                    );
                    array_push($phongcongtacsinhvienArr["phongcongtacsinhvien"], $e);
                }
                http_response_code(200);
                echo json_encode($phongcongtacsinhvienArr);
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
