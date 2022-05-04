<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/covanhoctap.php';
    include_once '../auth/read-data.php';

    $database = new Database();
    $db = $database->getConnection();

    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công và có phải giáo viên không
    if($data["status"]==1){

        //check quyền ctsv trước khi được phép call
        if ($data['user_data']->aud == "phongcongtacsinhvien" || $data['user_data']->aud == "khoa"){
            $items = new CVHT($db);
            $stmt = $items->getAllCVHT();
            $itemCount = $stmt->rowCount();

            $countRow = 0;

            if($itemCount > 0){
                $covanhoctapArr = array();
                $covanhoctapArr["covanhoctap"] = array(); //tạo object json 
                $covanhoctapArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maCoVanHocTap" => $maCoVanHocTap ,
                        "hoTenCoVan" => $hoTenCoVan,
                        "soDienThoai" => $soDienThoai,
                        "matKhauTaiKhoanCoVan" => $matKhauTaiKhoanCoVan
                    );
                    array_push($covanhoctapArr["covanhoctap"], $e);
                }
                http_response_code(200);
                echo json_encode($covanhoctapArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }

        }else{
            http_response_code(403);
            echo json_encode(
                array("message" => "Không có quyền thực hiện điều này!")
            );
        }

        
    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập!")
        );
    }

?>