<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    ini_set("display_errors",1);

    include_once '../../config/database.php';
    include_once '../../class/user_token.php';
    require '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key; 


    class read_data{
        
        //dùng cho check token trong header bên api ở mỗi request
        public static function read_token()
        {
            $database = new Database();
            $db = $database->getConnection();
    
            $userTokenClass = new UserToken($db);

            $all_headers = getallheaders();
            
            if(!empty($all_headers['Authorization'])){  
                $jwt = $all_headers['Authorization'];

                try {
                    $secret_key = "daihocsaigon";

                    $decoded_data = JWT::decode($jwt, new Key($secret_key,"HS256"));

                    //check token có tồn tại trong database hay không (tránh client gửi token rác)
                    //check token đã exprired hay chưa
                    if ($userTokenClass->checkUserTokenExist($jwt) && !$userTokenClass->isExprired($jwt)){

                        http_response_code(200);
                        
                        return array(
                            "status" => "1",
                            "user_data" => ($decoded_data)
                            );    
                    } else{
                        http_response_code(403);
                        return array(
                            "status" => "0",
                            "message" =>  "Vui lòng đăng nhập!"
                        );  
                    }

                } catch (\Throwable $th) {
                    http_response_code(500);
                    return array(
                        "status" => "0",
                        "message" =>  $th->getMessage()
                    );           
                }
            } else{
                http_response_code(403);
                echo json_encode("Vui lòng đăng nhập!");
            }
        }
    }
?>