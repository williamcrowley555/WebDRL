<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap3.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

       // if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)){
            if (isset($_GET['kichHoat'])) {
                $kichHoat = $_GET['kichHoat'];
            } else {
                $kichHoat = null;
            }

            if ($kichHoat != null) {
                $database = new Database();
                $db = $database->getConnection();
        
                $items = new Tieuchicap3($db);
                $stmt = $items->getAllTC3($kichHoat);
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0){
                    $tieuchicap3Arr = array();
                    $tieuchicap3Arr["tieuchicap3"] = array(); //tạo object json 
                    $tieuchicap3Arr["itemCount"] = $itemCount;

                    $countRow = 0;
        
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "matc3" => $matc3 ,
                            "noidung" => $noidung	,
                            "diem" => $diem,
                            "matc2" => $matc2,
                            "kichHoat" => $kichHoat
                        );
                        array_push($tieuchicap3Arr["tieuchicap3"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($tieuchicap3Arr);
                }
                else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                }
            } else {
                $database = new Database();
                $db = $database->getConnection();
        
                $items = new Tieuchicap3($db);
                $stmt = $items->getAllTC3();
                $itemCount = $stmt->rowCount();
        
                if($itemCount > 0){
                    $tieuchicap3Arr = array();
                    $tieuchicap3Arr["tieuchicap3"] = array(); //tạo object json 
                    $tieuchicap3Arr["itemCount"] = $itemCount;

                    $countRow = 0;
        
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        $countRow++;
                        $e = array(
                            "soThuTu" => $countRow,
                            "matc3" => $matc3 ,
                            "noidung" => $noidung	,
                            "diem" => $diem,
                            "matc2" => $matc2,
                            "kichHoat" => $kichHoat
                        );
                        array_push($tieuchicap3Arr["tieuchicap3"], $e);
                    }
                    http_response_code(200);
                    echo json_encode($tieuchicap3Arr);
                }
                else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
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