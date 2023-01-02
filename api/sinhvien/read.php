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
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {

        if (isset($_GET['maKhoa'])) {
            $maKhoa = $_GET['maKhoa'] == "tatcakhoa" ? null : $_GET['maKhoa'];
        } else {
            $maKhoa = null;
        }

        if (isset($_GET['maLop'])) {
            $maLop = $_GET['maLop'] == "tatcalop" ? null : $_GET['maLop'];
        } else {
            $maLop = null;
        }

        if (isset($_GET['mssv'])) {
            $mssv = $_GET['mssv'];
        } else {
            $mssv = null;
        }

        if (isset($_GET['maKhoa_quyen'])) {
            $maKhoa_quyen = $_GET['maKhoa_quyen'];
        } else {
            $maKhoa_quyen = null;
        }
        
        $database = new Database();
        $db = $database->getConnection();

        if ($mssv == null) {
            if ($maKhoa != null) {
                if ($maLop != null){
                    $items = new SinhVien($db);
                    $stmt = $items->getAllSinhVienTheoMaKhoaVaMaLop($maKhoa, $maLop);
                    $itemCount = $stmt->rowCount();
            
                    if ($itemCount > 0) {
    
                        $sinhvienArr = array();
                        $sinhvienArr["sinhvien"] = array(); //tạo object json 
                        $sinhvienArr["itemCount"] = $itemCount;
                    
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
                                "maLop" => $maLop,
                                "email" => $email,
                                "sdt" => $sdt,
                                "anhDaiDien" => $anhDaiDien,
                                "totNghiep" => $totNghiep
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
                    $items = new SinhVien($db);
                    $stmt = $items->getAllSinhVienTheoMaKhoa($maKhoa);
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
                                "maLop" => $maLop,
                                "email" => $email,
                                "sdt" => $sdt,
                                "anhDaiDien" => $anhDaiDien,
                                "totNghiep" => $totNghiep
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
                }
            } else {
                if ($maLop != null){
                    $items = new SinhVien($db);
                    $stmt = $items->getAllSinhVienTheoMaLop($maLop);
                    $itemCount = $stmt->rowCount();
            
                    if ($itemCount > 0) {
                        $sinhvienArr = array();
                        $sinhvienArr["sinhvien"] = array(); //tạo object json 
                        $sinhvienArr["itemCount"] = $itemCount;
                    
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
                                "maLop" => $maLop,
                                "email" => $email,
                                "sdt" => $sdt,
                                "anhDaiDien" => $anhDaiDien,
                                "totNghiep" => $totNghiep
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
                                "maLop" => $maLop,
                                "email" => $email,
                                "sdt" => $sdt,
                                "anhDaiDien" => $anhDaiDien,
                                "totNghiep" => $totNghiep
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
                }
            }
        } else {
            $items = new SinhVien($db);

            if ($maKhoa_quyen == null) {
                $stmt = $items->getSinhVienTheoMSSV($mssv, false);
            } else {
                $stmt = $items->getSinhVienTheoMSSVVaMaKhoa($mssv, $maKhoa_quyen, false);
            }

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
                        "maLop" => $maLop,
                        "email" => $email,
                        "sdt" => $sdt,
                        "anhDaiDien" => $anhDaiDien,
                        "totNghiep" => $totNghiep
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