<?php

    include_once __DIR__.'/../../../../config/database.php';
    include_once __DIR__.'/../../../../class/user_token.php';
    require __DIR__.'/../../../../vendor/autoload.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key; 

    
    class CheckCookie{
        
        //dùng cho check token bên client
        public static function read_data_token($jwt)
        {
        
            $database = new Database();
            $db = $database->getConnection();

            $userTokenClass = new UserToken($db);

            try {
                $secret_key = "daihocsaigon";

                $decoded_data = JWT::decode($jwt, new Key($secret_key,"HS256"));

                //check token có tồn tại trong database hay không (tránh client gửi token rác)
                if ($userTokenClass->checkUserTokenExist($jwt)){

                    http_response_code(200);
                    
                    return array(
                        "status" => "1",
                        "user_data" => ($decoded_data)
                        );    
                }else{
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
            
        }

        public function CheckAuthLogin(){
          

            if (!isset($_COOKIE['jwt'])){
                if ($_COOKIE['jwt'] == null){
                    header("Location: dangnhap.php");
                }
            }
            
        }

        public function CheckAuthOnlyLoginPage(){
            if (isset($_COOKIE['jwt'])){
                if ($_COOKIE['jwt'] != null){
                    echo "<script>window.location.href = 'tracuudiemrenluyen.php';</script>";
    
                }
            }
            
        }

    }
?>




