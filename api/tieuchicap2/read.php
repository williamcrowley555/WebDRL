<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap1.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new Tieuchicap2($db);
    $stmt = $items->getAllTC2();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $tieuchicap1Arr = array();
        $tieuchicap1Arr["tieuchicap1"] = array(); //tạo object json 
        $tieuchicap1Arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "matc2" => $matc2 ,
                "noidung" => $noidung,
                "matc1" => $matc1
            );
            array_push($tieuchicap1Arr["tieuchicap1"], $e);
        }
        echo json_encode($tieuchicap1Arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>