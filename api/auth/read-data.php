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
                    if ($userTokenClass->checkUserTokenExist($jwt)){

                        http_response_code(200);
                        // echo json_encode(array(
                        //     "status" => "1",
                        //     "user_data" => $decoded_data 
                        //     )
                        // );
                        return array(
                            "status" => "1",
                            "user_data" => ($decoded_data)
                            );    
                    }else{
                        
                        http_response_code(403);
                    }

                } catch (\Throwable $th) {
                    http_response_code(500);
                    return array(
                        "status" => "0",
                        "message" =>  $th->getMessage()
                    );           
                }

            
            }else{
                http_response_code(403);
                echo json_encode("Vui lòng đăng nhập!");
            }
        }

        
    }

     //$database = new Database();
     //$db = $database->getConnection();
//$read_data = new read_data();
    //if($_SERVER['REQUEST_METHOD']==='POST'){
      //  echo json_encode($read_data->read_token()) ;
    //}
    
      
?>