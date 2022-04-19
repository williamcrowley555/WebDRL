<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/tieuchicap3.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new Tieuchicap3($db);
        $item->matc3 = isset($_GET['matc3']) ? $_GET['matc3'] : die(); //Lấy id từ phương thức GET
    
        $item->getSingleTC3();
        if($item->noidung != null){
            // create array
            $tieuchicap3_arr = array(
                "matc3" =>  $item->matc3,
                "noidung" => $item->noidung,
                "diem" => $item->diem,
                "matc2" => $item->matc2
            );
        
            http_response_code(200);
            echo json_encode($tieuchicap3_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("tieuchicap3 not found.");
        }
    }
?>