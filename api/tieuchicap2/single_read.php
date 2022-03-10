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
    $item = new Tieuchicap2($db);
    $item->matc2 = isset($_GET['matc2']) ? $_GET['matc2'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleTC2();
    if($item->noidung != null){
        // create array
        $tieuchicap2_arr = array(
            "matc2" =>  $item->matc2,
            "noidung" => $item->noidung,
            "matc1" => $item->matc1
        );
      
        http_response_code(200);
        echo json_encode($tieuchicap2_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("tieuchicap2 not found.");
    }
?>