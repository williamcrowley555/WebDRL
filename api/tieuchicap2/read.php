<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap2.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        $database = new Database();
        $db = $database->getConnection();

        $items = new Tieuchicap2($db);
        $stmt = $items->getAllTC2();
        $itemCount = $stmt->rowCount();

        if($itemCount > 0){
            $tieuchicap2Arr = array();
            $tieuchicap2Arr["tieuchicap2"] = array(); //tạo object json 
            $tieuchicap2Arr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "matc2" => $matc2 ,
                    "noidung" => $noidung,
                    "matc1" => $matc1
                );
                array_push($tieuchicap2Arr["tieuchicap2"], $e);
            }
            echo json_encode($tieuchicap2Arr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
    }

?>