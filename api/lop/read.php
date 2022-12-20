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
    if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {

        if (isset($_GET['maKhoa'])) {
            $GET_maKhoa = $_GET['maKhoa'] == "tatcakhoa" ? null : $_GET['maKhoa'];
        } else {
            $GET_maKhoa = null;
        }

        if (isset($_GET['maKhoaHoc'])) {
            $GET_maKhoaHoc = $_GET['maKhoaHoc'];
        } else {
            $GET_maKhoaHoc = null;
        }

        if (isset($_GET['maLop'])) {
            $GET_maLop = $_GET['maLop'];
        } else {
            $GET_maLop = null;
        }

        if (isset($_GET['maCoVanHocTap'])) {
            $GET_maCoVanHocTap = $_GET['maCoVanHocTap'];
        } else {
            $GET_maCoVanHocTap = null;
        }

        if (isset($_GET['maKhoa_quyen'])) {
            $maKhoa_quyen = $_GET['maKhoa_quyen'];
        } else {
            $maKhoa_quyen = null;
        }

        if ($GET_maKhoa != null) {
            if ($GET_maKhoaHoc != null) {
                $items = new Lop($db);
            
                $stmt = $items->getAllLopTheoMaKhoaVaMaKhoaHoc($GET_maKhoa, $GET_maKhoaHoc);
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
            } else {
                $items = new Lop($db);
            
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
            }
        } else if ($GET_maCoVanHocTap != null) {
            $items = new Lop($db);
            
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
        } else if ($GET_maLop != null) {
            $items = new Lop($db);

            if ($maKhoa_quyen == null) {
                $stmt = $items->getLopTheoMaLop($GET_maLop, false);
            } else {
                $stmt = $items->getLopTheoMaLopVaMaKhoa($GET_maLop, $maKhoa_quyen, false);
            }
            
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
        } else {
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