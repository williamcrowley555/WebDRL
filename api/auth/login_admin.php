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
    include_once '../../class/user_token.php';
    include_once '../../class/phongcongtacsinhvien.php';

    // $data example:
    // {
    //      "taiKhoan": "ctsv1",
    //      "matKhau": "ctsv1"
    // }

    $data = json_decode(file_get_contents("php://input")); // nhan data json tu client post len
  
    if(!empty($data->taiKhoan) && !empty($data->matKhau)){
        $input_taiKhoan = $data->taiKhoan;
        $input_matKhau = $data->matKhau;

        if (check_login($input_taiKhoan, $input_matKhau)){
            http_response_code(200);
        }else{
            http_response_code(404);
            echo "Sai thông tin đăng nhập!";
        }
       

    }else{
        echo "Chưa gửi thông tin đăng nhập!";
    }


    //---Check login------
    function check_login($taiKhoan, $matKhau){
        $database = new Database();
        $db = $database->getConnection();

        //Sinh vien
        $obj_CTSV = new PhongCongTacSinhVien($db);
        $obj_CTSV->taiKhoan = htmlspecialchars(strip_tags($taiKhoan));
        $obj_CTSV->matKhau = htmlspecialchars(strip_tags(md5($matKhau)));

        $sqlQuery_CTSV = "SELECT * FROM phongcongtacsinhvien 
                    WHERE taiKhoan = ? AND matKhau = ? LIMIT 0,1";
        $stmt = $database->conn->prepare($sqlQuery_CTSV);
        $stmt->bindParam(1, $obj_CTSV->taiKhoan);
        $stmt->bindParam(2, $obj_CTSV->matKhau);
        $stmt->execute();
        $dataRow_CTSV = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow_CTSV != null){
            $obj_CTSV->taiKhoan  = $dataRow_CTSV['taiKhoan'];
            $obj_CTSV->hoTenNhanVien = $dataRow_CTSV['hoTenNhanVien'];
            $obj_CTSV->email = $dataRow_CTSV['email'];
            $obj_CTSV->sodienthoai = $dataRow_CTSV['sodienthoai'];
            $obj_CTSV->diaChi = $dataRow_CTSV['diaChi'];
            $obj_CTSV->quyen = $dataRow_CTSV['quyen'];

            $jwt = create_token("phongcongtacsinhvien",$obj_CTSV,"taiKhoan","hoTenNhanVien", "quyen");

            //Them phien dang nhap vao table user_token
            $objUserToken = new UserToken($db);
            $objUserToken->maSo = $obj_CTSV->taiKhoan;
            $objUserToken->token = $jwt;
            $objUserToken->quyen = $obj_CTSV->quyen;
            $objUserToken->thoiGianDangNhap = date("Y-m-d H:i:s");
            $objUserToken->thoiGianHetHan = date("Y-m-d H:i:s", strtotime('+24 hours'));


            if ($objUserToken->checkUserExist($objUserToken->maSo)){
                $objUserToken->deleteUserToken($objUserToken->maSo);
            }
               
            $objUserToken->createUserToken();

            $arr = array( 
                "taiKhoan" =>  $obj_CTSV->taiKhoan,
                "hoTenNhanVien" => $obj_CTSV->hoTenNhanVien,
                "quyen" => $obj_CTSV->quyen
            );
    
            echo json_encode(array(
                "login_status"=> 1,
                "jwt"=> $jwt,
                "message"=>"Login successful",
                $arr
            )); 
    
            return true;
            
        }

        return false;
        
    }




    //---Create token-------
    function create_token(
        String $aud , // ai la nguoi dang nhap
        $item ,
        String $ma ,
        String $hoten,
        String $quyen
        
     )
    {
        $iss = "localhost";
        $iat = time(); //thời gian đăng nhập
        $nbf = $iat + 10;
        // jwt valid for 1 day (60 seconds * 60 minutes * 24 hours * 1 days)
        $exp = $iat + 60*60*24; //token hết hạn sau 24 tiếng //thời gian hết hạn của tokenv
        $arr = array( 
            $ma =>  $item->$ma,
            $hoten => $item->$hoten,
            $quyen => $item->quyen
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
        return $jwt;
        
        // echo json_encode(array(
        //     "login_status"=> 1,
        //     "jwt"=> $jwt,
        //     "message"=>"Login successful",
        //     $arr
        // ));     
        
    }
