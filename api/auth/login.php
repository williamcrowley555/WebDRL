<?php
    //include vendor jwt
    require '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../../class/covanhoctap.php';
    include_once '../../class/khoa.php';


    $database = new Database();
    $db = $database->getConnection();

    // $data example:
    // {
    //      "id": "3118410262",
    //      "password": "123456",
    //      "quyen": "1",
    // }

    $data = json_decode(file_get_contents("php://input")); // nhan data json tu client post len
  
    if(!empty($data->id) && !empty($data->password) && !empty($data->quyen)){

        switch ($data->quyen) {

            // la sinh vien
            case 1:{
                $item = new SinhVien($db);
                $item->maSinhVien = $data->id;
                $item->matKhauSinhVien = md5($data->password);  
        
                if ($item->check_login()){
                    create_token("sinhvien",$item,"maSinhVien","hoTenSinhVien");
                    break;
             
            }else{
                http_response_code(404);
                echo "Sai thông tin đăng nhập!";
                break;
            } 
        }
                
            // la co van hoc tap
            case 2:{
                $item = new CVHT($db);
                $item->maCoVanHocTap = $data->id;
                $item->matKhauTaiKhoanCoVan = md5($data->password);  
        
                if ($item->check_login()){
                    create_token("cvht",$item,"maCoVanHocTap","hoTenCoVan");
                    break;
                }else{
                    http_response_code(404);
                    echo "Sai thông tin đăng nhập!";
                    break;
                }
            }

            // la can bo khoa
            case 3:{
                $item = new Khoa($db);
                $item->taiKhoanKhoa = $data->id;
                $item->matKhauKhoa = md5($data->password);  
            
                if ($item->check_login()){
                    create_token("khoa",$item,"taiKhoanKhoa","tenKhoa");
  
                    break; 
                }else{
                    http_response_code(404);
                    echo "Sai thông tin đăng nhập!";
                    break;
                }
            }
            
            default:{
                echo "Không tìm thấy quyền người dùng tương ứng!";
                break;
            }
               
                
        }

    }else{
        echo "Chưa gửi thông tin đăng nhập!";
    }
     function create_token(
        String $aud , // ai la nguoi dang nhap
        $item ,
        String $ma ,
        String $hoten
        
     )
    {
        $iss = "localhost";
        $iat = time(); //thời gian đăng nhập
        $nbf = $iat + 10;
        $exp = $iat + 60; //thời gian hết hạn của tokenv
        $arr = array( 
            $ma =>  $item->$ma,
            $hoten => $item->$hoten
        );


        $payload_info = array(
            "iss"=> $iss, //issuer
            "iat"=> $iat, // issued at
            "nbf"=> $nbf, // not before at issue
            "exp"=> $exp, //expiration time
            "aud"=> $aud, //audience
            $aud => $arr
        );

        $secret_key = "daihocsaigon";

        $jwt = JWT::encode($payload_info, $secret_key, "HS256"); //HS256 là thuật toán băm

        http_response_code(200);
        echo json_encode(array(
            "login_status"=> 1,
            "jwt"=> $jwt,
            "message"=>"Login successful",
            $arr
        ));     
        
    }   
        
?>