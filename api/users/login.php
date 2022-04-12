<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../../class/covanhoctap.php';
    include_once '../../class/khoa.php';
    require '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;


    $database = new Database();
    $db = $database->getConnection();

    $data = json_decode(file_get_contents("php://input")); // nhan data json tu client post len
  
    if($data != null){
        // la sinh vien
        if($data->quyen==1){
            $item = new SinhVien($db);
            $item->maSinhVien = $data->id;
            $item->matKhauSinhVien = md5($data->password);  
    
            if ($item->check_login()){
                

                $iss = "localhost";
                $iat = time();
                $nbf = $iat + 10 ;
                $exp = $iat + 60 ;
                $aud = "student";
                $sinhvien_arr = array(
                    "quyen" => "1",
                    "maSinhVien" =>  $item->maSinhVien,
                    "hoTenSinhVien" => $item->hoTenSinhVien,
                    "ngaySinh" => $item->ngaySinh,
                    "he" => $item->he,
                    "maLop" => $item->maLop,
                );

                $payload_info = array (
                    //"iss"=>$iss,
                   // "iat"=>$iat,
                   // "nbf"=>$nbf,
                   // "exp"=>$exp,
                   // "aud"=>$aud,
                    "data"=>$sinhvien_arr
                );

                $secret_key = "owt125";

                $jwt = JWT::encode($payload_info,$secret_key,"HS512");
                
                // create array
                $sinhvien_arr = array(
                    "login status" => "successful",
                    "jwt" => $jwt 
                );
    
                http_response_code(200);
                echo json_encode($sinhvien_arr);         
        } else{
            http_response_code(404);
            echo json_encode("login faill");
        }
    }
            // la giao vien
            if($data->quyen==2){
                $item = new CVHT($db);
                $item->maCoVanHocTap = $data->id;
                $item->matKhauTaiKhoanCoVan = md5($data->password);  
        
                if ($item->check_login()){
                    // create array
                    $covanhoctap_arr = array(
                        "login status" => "successful",
                        "quyen" => "2",
                        "maCoVanHocTap" =>  $item->maCoVanHocTap,
                        "hoTenCoVan" => $item->hoTenCoVan,
                        "soDienThoai" => $item->soDienThoai
                        
                    );
        
                    http_response_code(200);
                    echo json_encode($covanhoctap_arr);         
            } else{
                http_response_code(404);
                echo json_encode("login faill");
            }
        }
                // la can bo khoa
                if($data->quyen==3){
                    $item = new Khoa($db);
                    $item->taiKhoanKhoa = $data->id;
                    $item->matKhauKhoa = md5($data->password);  
            
                    if ($item->check_login()){
                        // create array
                        $khoa_arr = array(
                            "login status" => "successful",
                            "quyen" => "3",
                            "maKhoa" =>  $item->maKhoa,
                            "tenKhoa" => $item->tenKhoa,                            
                        );
            
                        http_response_code(200);
                        echo json_encode($khoa_arr);         
                } else{
                    http_response_code(404);
                    echo json_encode("login faill");
                }
            }
            

    }
?>