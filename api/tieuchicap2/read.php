<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap2.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();

    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)){
            $database = new Database();
            $db = $database->getConnection();
    
            $items = new Tieuchicap2($db);
            $stmt = $items->getAllTC2();
            $itemCount = $stmt->rowCount();
    
            if($itemCount > 0){
                $tieuchicap2Arr = array();
                $tieuchicap2Arr["tieuchicap2"] = array(); //tạo object json 
                $tieuchicap2Arr["itemCount"] = $itemCount;

                $countRow = 0;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "matc2" => $matc2 ,
                        "noidung" => $noidung,
                        "matc1" => $matc1
                    );
                    array_push($tieuchicap2Arr["tieuchicap2"], $e);
                }
                http_response_code(200);
                echo json_encode($tieuchicap2Arr);
            }else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không có dữ liệu.")
                );
            }
        }else{
            http_response_code(403);
            echo json_encode(
                array("message" => "Bạn không có quyền thực hiện điều này!")
            );
        }
        
    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>