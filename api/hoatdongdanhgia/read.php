<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $database = new Database();
    $db = $database->getConnection();

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    //get domain dùng cho link file
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
    else $url = "http://";   

    $url .= $_SERVER['HTTP_HOST'];  

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        if (isset($_GET['from'])) {
            $from = $_GET['from'];
        } else {
            $from = null;
        }

        if (isset($_GET['to'])) {
            $to = $_GET['to'];
        } else {
            $to = null;
        }
       
        if (isset($_GET['maKhoa'])) {
            $maKhoa = $_GET['maKhoa'];
        } else {
            $maKhoa = null;
        }
        
        if (isset($_GET['maSinhVien'])) {
            $maSinhVien = $_GET['maSinhVien'];
        } else {
            $maSinhVien = null;
        }

        if (isset($_GET['maHocKyDanhGia'])) {
            $maHocKyDanhGia = $_GET['maHocKyDanhGia'];
        } else {
            $maHocKyDanhGia = null;
        }
       
        if (isset($_GET['maHD'])) {
            $maHD = $_GET['maHD'];
        } else {
            $maHD = null;
        }

        if($from != null && $to != null) {
            $from = str_replace("%20", " ", $from);
            $to = str_replace("%20", " ", $to);

            $items = new HoatDongDanhGia($db);

            if ($maKhoa == null) {
                $stmt = $items->getHoatDongTheoKhoangThoiGian($from, $to);
            } else {
                $stmt = $items->getHoatDongTheoKhoangThoiGianVaMaKhoa($from, $to, $maKhoa);
            }

            $itemCount = $stmt->rowCount();
    
    
            if($itemCount > 0){
                $hoatdongdanhgiaArr = array();
                $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
                $hoatdongdanhgiaArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maHoatDong" => $maHoatDong ,
                        "maTieuChi3" => $maTieuChi3,
                        "maTieuChi2" => $maTieuChi2,
                        "maKhoa" => $maKhoa,
                        "tenHoatDong" => $tenHoatDong,
                        "diemNhanDuoc" => $diemNhanDuoc,
                        "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "thoiGianBatDauDiemDanh" => $thoiGianBatDauDiemDanh,
                        "maQRDiaDiem" => $urlFile.$maQRDiaDiem,
                        "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                        "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong,
                        "noiDungTieuChi" => $noiDungTieuChi,
                    );
                    array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
                }
                http_response_code(200);
                echo json_encode($hoatdongdanhgiaArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        } else if ($maSinhVien != null && $maHocKyDanhGia != null) {
            $items = new HoatDongDanhGia($db);
            $stmt = $items->getAllTheoMSSVAndMaHKDG($maSinhVien, $maHocKyDanhGia);
            $itemCount = $stmt->rowCount();
    
    
            if($itemCount > 0){
                $hoatdongdanhgiaArr = array();
                $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
                $hoatdongdanhgiaArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maHoatDong" => $maHoatDong ,
                        "maTieuChi3" => $maTieuChi3,
                        "maTieuChi2" => $maTieuChi2,
                        "maKhoa" => $maKhoa,
                        "tenHoatDong" => $tenHoatDong,
                        "diemNhanDuoc" => $diemNhanDuoc,
                        "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "thoiGianBatDauDiemDanh" => $thoiGianBatDauDiemDanh,
                        "maQRDiaDiem" => $urlFile.$maQRDiaDiem,
                        "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                        "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong,
                    );
                    array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
                }
                http_response_code(200);
                echo json_encode($hoatdongdanhgiaArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        } else if ($maHD == null) {
            $items = new HoatDongDanhGia($db);

            if ($maKhoa == null) {
                $stmt = $items->getAllHoatDongDanhGia();
            } else {
                $stmt = $items->getHoatDongTheoMaKhoa($maKhoa);
            }

            $itemCount = $stmt->rowCount();
    
            if($itemCount > 0) {
                $hoatdongdanhgiaArr = array();
                $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
                $hoatdongdanhgiaArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maHoatDong" => $maHoatDong ,
                        "maTieuChi3" => $maTieuChi3,
                        "maTieuChi2" => $maTieuChi2,
                        "maKhoa" => $maKhoa,
                        "tenHoatDong" => $tenHoatDong,
                        "diemNhanDuoc" => $diemNhanDuoc,
                        "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "thoiGianBatDauDiemDanh" => $thoiGianBatDauDiemDanh,
                        "maQRDiaDiem" => $urlFile.$maQRDiaDiem,
                        "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                        "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong,
                        "noiDungTieuChi" => $noiDungTieuChi,
                    );
                    array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
                }
                http_response_code(200);
                echo json_encode($hoatdongdanhgiaArr);
            }
            else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        } else {
            $items = new HoatDongDanhGia($db);

            if ($maKhoa == null) {
                $stmt = $items->getHoatDongTheoMaHD($maHD);
            } else {
                $stmt = $items->getHoatDongTheoMaHDVaMaKhoa($maHD, $maKhoa);
            }

            $itemCount = $stmt->rowCount();
    
            if($itemCount > 0){
                $hoatdongdanhgiaArr = array();
                $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
                $hoatdongdanhgiaArr["itemCount"] = $itemCount;
    
                $urlFile = $url.dirname($_SERVER['PHP_SELF'])."/QRImages/";
    
                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maHoatDong" => $maHoatDong ,
                        "maTieuChi3" => $maTieuChi3,
                        "maTieuChi2" => $maTieuChi2,
                        "maKhoa" => $maKhoa,
                        "tenHoatDong" => $tenHoatDong,
                        "diemNhanDuoc" => $diemNhanDuoc,
                        "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                        "maHocKyDanhGia" => $maHocKyDanhGia,
                        "thoiGianBatDauDiemDanh" => $thoiGianBatDauDiemDanh,
                        "maQRDiaDiem" => $urlFile.$maQRDiaDiem,
                        "thoiGianBatDauHoatDong" => $thoiGianBatDauHoatDong,
                        "thoiGianKetThucHoatDong" => $thoiGianKetThucHoatDong,
                        "noiDungTieuChi" => $noiDungTieuChi,
                    );
                    array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
                }
                http_response_code(200);
                echo json_encode($hoatdongdanhgiaArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
?>