<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap3.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new Tieuchicap3($db);
    $stmt = $items->getAllTC3();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $tieuchicap3Arr = array();
        $tieuchicap3Arr["tieuchicap3"] = array(); //tạo object json 
        $tieuchicap3Arr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "matc3" => $matc3 ,
                "noidung" => $noidung	,
                "diem" => $diem,
                "matc2" => $matc2
            );
            array_push($tieuchicap3Arr["tieuchicap3"], $e);
        }
        echo json_encode($tieuchicap3Arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>