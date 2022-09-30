<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/lop.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$database = new Database();
$db = $database->getConnection();

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV($data["user_data"]->aud)) {

        if (isset($_GET["maKhoa"])){
            $items = new Lop($db);
    
            $GET_maKhoa = $_GET['maKhoa']; //Lấy id từ phương thức GET
            
            $stmt = $items->getAllLopTheoMaKhoa($GET_maKhoa);
            $itemCount = $stmt->rowCount();
    
            if ($itemCount > 0) {
                $lopArr = array();
                $lopArr["lop"] = array(); //tạo object json 
                $lopArr["itemCount"] = $itemCount;
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maLop" => $maLop,
                        "tenLop" => $tenLop,
                        "maKhoa" => $maKhoa,
                        "maCoVanHocTap" => $maCoVanHocTap,
                        "maKhoaHoc" => $maKhoaHoc
                    );
                    array_push($lopArr["lop"], $e);
                }
                http_response_code(200);
                echo json_encode($lopArr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }


        }else{
            if (isset($_GET["maCoVanHocTap"])){
                $items = new Lop($db);
    
                $GET_maCoVanHocTap = isset($_GET['maCoVanHocTap']) ? $_GET['maCoVanHocTap'] : die(); //Lấy id từ phương thức GET
                
                $stmt = $items->getAllLopTheoMaCoVan($GET_maCoVanHocTap);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $lopArr = array();
                    $lopArr["lop"] = array(); //tạo object json 
                    $lopArr["itemCount"] = $itemCount;
                    $countRow = 0;
        
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "maLop" => $maLop,
                            "tenLop" => $tenLop,
                            "maKhoa" => $maKhoa,
                            "maCoVanHocTap" => $maCoVanHocTap,
                            "maKhoaHoc" => $maKhoaHoc
                        );
                        array_push($lopArr["lop"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($lopArr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
    
            }else{
                $items = new Lop($db);
                $stmt = $items->getAllLop();
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $lopArr = array();
                    $lopArr["lop"] = array(); //tạo object json 
                    $lopArr["itemCount"] = $itemCount;
                    $countRow = 0;
        
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "maLop" => $maLop,
                            "tenLop" => $tenLop,
                            "maKhoa" => $maKhoa,
                            "maCoVanHocTap" => $maCoVanHocTap,
                            "maKhoaHoc" => $maKhoaHoc
                        );
                        array_push($lopArr["lop"], $e);
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