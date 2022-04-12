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
  
    if($data != null){

        switch ($data->quyen) {

            // la sinh vien
            case 1:{
                $item = new SinhVien($db);
                $item->maSinhVien = $data->id;
                $item->matKhauSinhVien = md5($data->password);  
        
                if ($item->check_login()){
                    
                    $iss = "localhost";
                    $iat = time(); //thời gian đăng nhập
                    $nbf = $iat + 10;
                    $exp = $iat + 30; //thời gian hết hạn của token
                    $sinhvien_arr = array(
                        "quyen" => "1",
                        "maSinhVien" =>  $item->maSinhVien,
                        "hoTenSinhVien" => $item->hoTenSinhVien,
                        "ngaySinh" => $item->ngaySinh,
                        "he" => $item->he,
                        "maLop" => $item->maLop,
                    );


                    $payload_info = array(
                        "iss"=> $iss, //issuer
                        "iat"=> $iat, // issued at
                        "nbf"=> $nbf, // not before at issue
                        "exp"=> $exp, //expiration time
                        //"aud"=>, //audience
                        "sinhvien_arr"=> $sinhvien_arr
                    );

                    $secret_key = "daihocsaigon";

                    $jwt = JWT::encode($payload_info, $secret_key, "HS256"); //HS256 là thuật toán băm
    
                    http_response_code(200);
                    echo json_encode(array(
                        "login_status"=> 1,
                        "jwt"=> $jwt,
                        "message"=>"Login successful",
                        $sinhvien_arr
                    ));     
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
                    // create array
                    $khoa_arr = array(
                        "login status" => "successful",
                        "quyen" => "3",
                        "maKhoa" =>  $item->maKhoa,
                        "tenKhoa" => $item->tenKhoa,                            
                    );
            
                    http_response_code(200);
                    echo json_encode($khoa_arr);   
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
    


    
?>