<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap1.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)){
            if (isset($_GET['matc2'])) {
                $matc2 = $_GET['matc2'];
            } else {
                $matc2 = null;
            }

            if (isset($_GET['matc3'])) {
                $matc3 = $_GET['matc3'];
            } else {
                $matc3 = null;
            }

            if ($matc2 != null) {
                $matc2 = explode(",", $matc2);

                if (count($matc2) > 1) {
                    $database = new Database();
                    $db = $database->getConnection();
            
                    $items = new Tieuchicap1($db);
                    $stmt = $items->getAllTC1TheoMatc2($matc2);
                    $itemCount = $stmt->rowCount();
            
                    if($itemCount > 0){
                        $tieuchicap1Arr = array();
                        $tieuchicap1Arr["tieuchicap1"] = array(); //tạo object json 
                        $tieuchicap1Arr["itemCount"] = $itemCount;
            
                        $countRow = 0;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            $countRow++;
                            $e = array(
                                "soThuTu" => $countRow,
                                "matc1" => $matc1 ,
                                "noidung" => $noidung,
                                "diemtoida" => $diemtoida,
                                "kichHoat" => $kichHoat
                            );
                            array_push($tieuchicap1Arr["tieuchicap1"], $e);
                        }
                        http_response_code(200);
                        echo json_encode($tieuchicap1Arr);
                    }else{
                        http_response_code(404);
                        echo json_encode(
                            array("message" => "Không có dữ liệu.")
                        );
                    }
                }

            } else if ($matc3 != null) {
                $matc3 = explode(",", $matc3);

                if (count($matc3) > 1) {
                    $database = new Database();
                    $db = $database->getConnection();
            
                    $items = new Tieuchicap1($db);
                    $stmt = $items->getAllTC1TheoMatc3($matc3);
                    $itemCount = $stmt->rowCount();
            
                    if($itemCount > 0){
                        $tieuchicap1Arr = array();
                        $tieuchicap1Arr["tieuchicap1"] = array(); //tạo object json 
                        $tieuchicap1Arr["itemCount"] = $itemCount;
            
                        $countRow = 0;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            $countRow++;
                            $e = array(
                                "soThuTu" => $countRow,
                                "matc1" => $matc1 ,
                                "noidung" => $noidung,
                                "diemtoida" => $diemtoida,
                                "kichHoat" => $kichHoat
                            );
                            array_push($tieuchicap1Arr["tieuchicap1"], $e);
                        }
                        http_response_code(200);
                        echo json_encode($tieuchicap1Arr);
                    }else{
                        http_response_code(404);
                        echo json_encode(
                            array("message" => "Không có dữ liệu.")
                        );
                    }
                }

            } else {
                $database = new Database();
                $db = $database->getConnection();
        
                $items = new Tieuchicap1($db);
                $stmt = $items->getAllTC1();
                $itemCount = $stmt->rowCount();
        
        
                if($itemCount > 0){
                    $tieuchicap1Arr = array();
                    $tieuchicap1Arr["tieuchicap1"] = array(); //tạo object json 
                    $tieuchicap1Arr["itemCount"] = $itemCount;
        
                    $countRow = 0;

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "matc1" => $matc1 ,
                            "noidung" => $noidung,
                            "diemtoida" => $diemtoida,
                            "kichHoat" => $kichHoat
                        );
                        array_push($tieuchicap1Arr["tieuchicap1"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($tieuchicap1Arr);
                }else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không có dữ liệu.")
                    );
                }
            }
        // }else{
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }

    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }


?>