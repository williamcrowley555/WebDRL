<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    ini_set("display_errors",1);

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../../class/covanhoctap.php';
    include_once '../../class/khoa.php';
    require '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key; 


    $database = new Database();
    $db = $database->getConnection();

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $data = json_decode(file_get_contents("php://input")); // nhan data json tu client post len
        if(!empty($data->jwt)){  
            try {
                $secret_key = "owt125";

                $decoded_data = JWT::decode($data->jwt, new Key($secret_key,"HS512"));
                http_response_code(200);
                echo json_encode(array(
                    "status" => "1",
                    "user_data" => $decoded_data 
                    )
                );             
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(array(
                    "status" => "0",
                    "message" =>  $th->getMessage()
                    )
                );             
            }

          
        }else{
            http_response_code(200);
            echo json_encode("not enough data");
        }

    }




?>