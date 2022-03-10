<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap3.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Tieuchicap3($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maKhoa = $data->maKhoa;
    
        if($item->deleteTC3()){
            echo json_encode("TC3 deleted.");
        } else{
            echo json_encode("Data could not be deleted");
        }
    }else{
        echo 'No data posted.';
    }
   

?>