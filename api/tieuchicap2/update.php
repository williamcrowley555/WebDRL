<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap2.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Khoa($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->matc2 = $data->matc2;
    
        //values
        $item->noidung = $data->noidung;
        $item->matc1 = $data->matc1;
        
        if($item->updateKhoa()){
            echo json_encode("tieuchicap2 data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>