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

       // if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)){
            if (isset($_GET['matc3'])) {
                $matc3 = $_GET['matc3'];
            } else {
                $matc3 = null;
            }

            if (isset($_GET['kichHoat'])) {
                $kichHoat = $_GET['kichHoat'];
            } else {
                $kichHoat = null;
            }
            
            if ($matc3 != null) {
                $matc3 = explode(",", $matc3);

                if (count($matc3) > 1) {
                    $database = new Database();
                    $db = $database->getConnection();
            
                    $items = new Tieuchicap2($db);
                    $stmt = $items->getAllTC2TheoMatc3($matc3, 0);
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
                                "diemtoida" => $diemtoida,
                                "matc1" => $matc1,
                                "kichHoat" => $kichHoat
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
                }
            } else if ($kichHoat != null) {
                $database = new Database();
                $db = $database->getConnection();
        
                $items = new Tieuchicap2($db);
                $stmt = $items->getAllTC2($kichHoat);
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
                            "diemtoida" => $diemtoida,
                            "matc1" => $matc1,
                            "kichHoat" => $kichHoat
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
            } else {
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
                            "diemtoida" => $diemtoida,
                            "matc1" => $matc1,
                            "kichHoat" => $kichHoat
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