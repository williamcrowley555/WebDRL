<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/thongbaodanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

       // if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)){

            if (isset($_GET['maThongBao'])) {
                $maThongBao = $_GET['maThongBao'];
            } else {
                $maThongBao = null;
            }

            if (isset($_GET['maHocKyDanhGia'])) {
                $maHocKyDanhGia = $_GET['maHocKyDanhGia'];
            } else {
                $maHocKyDanhGia = null;
            }

            $database = new Database();
            $db = $database->getConnection();
            $item = new ThongBaoDanhGia($db);

            if ($maThongBao != null){
                $item->maThongBao = $maThongBao;

                $item->getSingleThongBaoDanhGia();
                if($item->ngaySinhVienDanhGia != null){
                    // create array
                    $thongbaodanhgia_arr = array(
                        "maThongBao" =>  $item->maThongBao,
                        "ngaySinhVienDanhGia" => $item->ngaySinhVienDanhGia,
                        "ngaySinhVienKetThucDanhGia" => $item->ngaySinhVienKetThucDanhGia,
                        "ngayCoVanDanhGia" => $item->ngayCoVanDanhGia,
                        "ngayCoVanKetThucDanhGia" => $item->ngayCoVanKetThucDanhGia,
                        "ngayKhoaDanhGia" => $item->ngayKhoaDanhGia,
                        "ngayKhoaKetThucDanhGia" => $item->ngayKhoaKetThucDanhGia,
                        "ngayThongBao" => $item->ngayThongBao,
                        "ngayKhieuNai" => $item->ngayKhieuNai,
                        "ngayKetThucKhieuNai" => $item->ngayKetThucKhieuNai,
                        "tuDongThongBao" => $item->tuDongThongBao,
                        "maHocKyDanhGia" => $item->maHocKyDanhGia        
                    );

                    http_response_code(200);
                    echo json_encode($thongbaodanhgia_arr);
                }
            } else if ($maHocKyDanhGia != null) {
                $item->maHocKyDanhGia = $maHocKyDanhGia;

                $item->getSingleThongBaoDanhGia_HocKyDanhGia();
                if($item->ngaySinhVienDanhGia != null){
                    // create array
                    $thongbaodanhgia_arr = array(
                        "maThongBao" =>  $item->maThongBao,
                        "ngaySinhVienDanhGia" => $item->ngaySinhVienDanhGia,
                        "ngaySinhVienKetThucDanhGia" => $item->ngaySinhVienKetThucDanhGia,
                        "ngayCoVanDanhGia" => $item->ngayCoVanDanhGia,
                        "ngayCoVanKetThucDanhGia" => $item->ngayCoVanKetThucDanhGia,
                        "ngayKhoaDanhGia" => $item->ngayKhoaDanhGia,
                        "ngayKhoaKetThucDanhGia" => $item->ngayKhoaKetThucDanhGia,
                        "ngayThongBao" => $item->ngayThongBao,
                        "ngayKhieuNai" => $item->ngayKhieuNai,
                        "ngayKetThucKhieuNai" => $item->ngayKetThucKhieuNai,
                        "tuDongThongBao" => $item->tuDongThongBao,
                        "maHocKyDanhGia" => $item->maHocKyDanhGia        
                    );

                    http_response_code(200);
                    echo json_encode($thongbaodanhgia_arr);
                }
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }

        // }else{
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }
    
    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
?>