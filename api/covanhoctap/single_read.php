<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/covanhoctap.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1) {
        //if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {
            if (isset($_GET['maCoVanHocTap'])) {
                $maCoVanHocTap = $_GET['maCoVanHocTap'];
            } else {
                $maCoVanHocTap = null;
            }

            if (isset($_GET['matKhau'])) {
                $matKhau = $_GET['matKhau'];
            } else {
                $matKhau = null;
            }

            if ($maCoVanHocTap != null && $matKhau != null) {
                $database = new Database();
                $db = $database->getConnection();

                $items = new CVHT($db);
                $stmt = $items->getSingleCVHTTheoMaCoVanHocTapVaMatKhau($maCoVanHocTap, md5($matKhau));
                $itemCount = $stmt->rowCount();
        
                if ($itemCount == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    extract($row);
                    $sv = array(
                        "maCoVanHocTap" => $maCoVanHocTap,
                        "hoTenCoVan" => $hoTenCoVan,
                        "soDienThoai" => $soDienThoai,
                        "maKhoa" => $maKhoa,
                        "matKhauTaiKhoanCoVan" => $matKhauTaiKhoanCoVan,
                        "email" => $email,
                        "soDienThoai" => $soDienThoai,
                        "anhDaiDien" => $anhDaiDien
                    );
                    
                    http_response_code(200);    
                    echo json_encode($sv);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
            } else if ($maCoVanHocTap != null) {
                $database = new Database();
                $db = $database->getConnection();
                $item = new CVHT($db);
                $item->maCoVanHocTap = isset($_GET['maCoVanHocTap']) ? $_GET['maCoVanHocTap'] : die(); //Lấy id từ phương thức GET
            
                $item->getSingleCVHT();

                if($item->hoTenCoVan != null) {
                    // create array
                    $covanhoctap_arr = array(
                        "maCoVanHocTap" =>  $item->maCoVanHocTap,
                        "hoTenCoVan" => $item->hoTenCoVan,
                        "soDienThoai" => $item->soDienThoai,
                        "maKhoa" => $item->maKhoa,
                        "matKhauTaiKhoanCoVan" => $item->matKhauTaiKhoanCoVan,
                        "email" => $item->email,
                        "soDienThoai" => $item->soDienThoai,
                        "anhDaiDien" => $item->anhDaiDien,

                    );
                
                    http_response_code(200);
                    echo json_encode($covanhoctap_arr);
                }
                else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không có dữ liệu.")
                    );
                } 
            // } else {
            //     http_response_code(403);
            //     echo json_encode(
            //         array("message" => "Bạn không có quyền thực hiện điều này!")
            //     );
            }
        //}
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
        
    
?>