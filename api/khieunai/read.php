<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/khieunai.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)) {

            if (isset($_GET['maKhoa'])) {
                $maKhoa = $_GET['maKhoa'];
            } else {
                $maKhoa = null;
            }

            if (isset($_GET['maKhoaHoc'])) {
                $maKhoaHoc = $_GET['maKhoaHoc'];
            } else {
                $maKhoaHoc = null;
            }

            if (isset($_GET['maHocKyDanhGia'])) {
                $maHocKyDanhGia = $_GET['maHocKyDanhGia'];
            } else {
                $maHocKyDanhGia = null;
            }

            if (isset($_GET['maSinhVien'])) {
                $maSinhVien = $_GET['maSinhVien'];
            } else {
                $maSinhVien = null;
            }

            $database = new Database();
            $db = $database->getConnection();
    
            if ($maKhoa != null && $maKhoaHoc != null && $maHocKyDanhGia != null) {
                $items = new KhieuNai($db);
                $stmt = $items->getDetailsAll($maKhoa, $maKhoaHoc, $maHocKyDanhGia);
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0) {
                    $khoaArr = array();
                    $khoaArr["khieunai"] = array(); //tạo object json 
                    $khoaArr["itemCount"] = $itemCount;
                    
                    $countRow = 0;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "maKhieuNai" => $maKhieuNai,
                            "maPhieuRenLuyen" => $maPhieuRenLuyen,
                            "lyDoKhieuNai" => $lyDoKhieuNai,
                            "minhChung" => $minhChung,
                            "trangThai" => $trangThai,
                            "thoiGianKhieuNai" => $thoiGianKhieuNai,
                            "loiNhan" => $loiNhan,
                            "lyDoTuChoi" => $lyDoTuChoi,
                            "maHocKyDanhGia" => $maHocKyDanhGia,
                            "maSinhVien" => $maSinhVien,
                            "hoTenSinhVien" => $hoTenSinhVien,
                            "maLop" => $maLop,
                        );
                        array_push($khoaArr["khieunai"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($khoaArr);
            
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
            } else if ($maSinhVien != null) {
                $items = new KhieuNai($db);
                $stmt = $items->getDetailsKhieuNaiTheoMSSV($maSinhVien, false);
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0) {
                    $khoaArr = array();
                    $khoaArr["khieunai"] = array(); //tạo object json 
                    $khoaArr["itemCount"] = $itemCount;
                    
                    $countRow = 0;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "maKhieuNai" => $maKhieuNai,
                            "maPhieuRenLuyen" => $maPhieuRenLuyen,
                            "lyDoKhieuNai" => $lyDoKhieuNai,
                            "minhChung" => $minhChung,
                            "trangThai" => $trangThai,
                            "thoiGianKhieuNai" => $thoiGianKhieuNai,
                            "loiNhan" => $loiNhan,
                            "lyDoTuChoi" => $lyDoTuChoi,
                            "maHocKyDanhGia" => $maHocKyDanhGia,
                            "maSinhVien" => $maSinhVien,
                            "hoTenSinhVien" => $hoTenSinhVien,
                            "maLop" => $maLop,
                        );
                        array_push($khoaArr["khieunai"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($khoaArr);
            
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
            } else {
                $items = new KhieuNai($db);
                $stmt = $items->getAllKhieuNai();
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0) {
                    $khoaArr = array();
                    $khoaArr["khieunai"] = array(); //tạo object json 
                    $khoaArr["itemCount"] = $itemCount;
                    
                    $countRow = 0;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "maKhieuNai" => $maKhieuNai,
                            "maPhieuRenLuyen" => $maPhieuRenLuyen,
                            "lyDoKhieuNai" => $lyDoKhieuNai,
                            "minhChung" => $minhChung,
                            "trangThai" => $trangThai,
                            "thoiGianKhieuNai" => $thoiGianKhieuNai,
                            "loiNhan" => $loiNhan,
                            "lyDoTuChoi" => $lyDoTuChoi,
                        );
                        array_push($khoaArr["khieunai"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($khoaArr);
            
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
    }else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>