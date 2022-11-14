<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/token.php';

    // $data example:
    // {
    //      "maSo": "3118410262"
    // }

    $data = json_decode(file_get_contents("php://input")); // nhan data json tu client post len
  
    if(!empty($data->maSo)){
        $input_maSo = $data->maSo;

        if (logout($input_maSo)){
            http_response_code(200);
        }else{
            http_response_code(404);
            echo "Không tìm thấy người user đã đăng nhập!";
        }
       

    }else{
        echo "Chưa gửi thông tin đăng xuất!";
    }


    //---logout------
    function logout($maSo){
        $database = new Database();
        $db = $database->getConnection();

        //Sinh vien
        $obj_UserToken = new UserToken($db);
        $obj_UserToken->maSo = $maSo;


        if ($obj_UserToken->checkUserExist($obj_UserToken->maSo)){
            $obj_UserToken->deleteUserToken($obj_UserToken->maSo);

            echo json_encode(array(
                "logout_status"=> 1,
                "message"=>"Xóa token thành công!"
            )); 

            return true;
        }

            
        return false;
        
    }
?>