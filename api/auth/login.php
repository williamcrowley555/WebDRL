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
    include_once '../../class/user_token.php';

    // $data example:
    // {
    //      "taiKhoan": "3118410262",
    //      "matKhau": "123456"
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
        $obj_SinhVien = new SinhVien($db);
        $obj_SinhVien->maSinhVien = $taiKhoan;
        $obj_SinhVien->matKhauSinhVien = md5($matKhau);

        $sqlQuery_SinhVien = "SELECT * FROM sinhvien 
                    WHERE maSinhVien = ? AND matKhauSinhVien = ? LIMIT 0,1";
        $stmt_SinhVien = $database->conn->prepare($sqlQuery_SinhVien);
        $stmt_SinhVien->bindParam(1, $obj_SinhVien->maSinhVien);
        $stmt_SinhVien->bindParam(2, $obj_SinhVien->matKhauSinhVien);
        $stmt_SinhVien->execute();
        $dataRow_SinhVien = $stmt_SinhVien->fetch(PDO::FETCH_ASSOC);

        if ($dataRow_SinhVien != null){
            $obj_SinhVien->maSinhVien  = $dataRow_SinhVien['maSinhVien'];
            $obj_SinhVien->hoTenSinhVien = $dataRow_SinhVien['hoTenSinhVien'];
            $obj_SinhVien->ngaySinh = $dataRow_SinhVien['ngaySinh'];
            $obj_SinhVien->he = $dataRow_SinhVien['he'];
            $obj_SinhVien->maLop = $dataRow_SinhVien['maLop'];
            $obj_SinhVien->quyen = $dataRow_SinhVien['quyen'];

            $jwt = create_token("sinhvien",$obj_SinhVien,"maSinhVien","hoTenSinhVien", "quyen");

            //Them phien dang nhap vao table user_token
            $objUserToken = new UserToken($db);
            $objUserToken->maSo = $obj_SinhVien->maSinhVien;
            $objUserToken->token = $jwt;
            $objUserToken->quyen = $obj_SinhVien->quyen;
            $objUserToken->thoiGianDangNhap = date("Y-m-d H:i:s");
            $objUserToken->thoiGianHetHan = date("Y-m-d H:i:s", strtotime('+24 hours'));

            if ($objUserToken->checkUserExist($objUserToken->maSo)){
                $objUserToken->deleteUserToken($objUserToken->maSo);
            }

            $objUserToken->createUserToken();

            $arr = array( 
                "maSo" =>  $obj_SinhVien->maSinhVien,
                "hoTen" => $obj_SinhVien->hoTenSinhVien,
                "quyen" => $obj_SinhVien->quyen
            );

            echo json_encode(array(
                "login_status"=> 1,
                "jwt"=> $jwt,
                "message"=>"Login successful",
                $arr
            )); 

            return true;

        }

        //Co van hoc tap
        $obj_CVHT = new CVHT($db);
        $obj_CVHT->maCoVanHocTap = $taiKhoan;
        $obj_CVHT->matKhauTaiKhoanCoVan = md5($matKhau);  

        $sqlQuery_CVHT = "SELECT * FROM covanhoctap 
                    WHERE maCoVanHocTap = ? AND matKhauTaiKhoanCoVan = ?  LIMIT 0,1";
        $stmt_CVHT = $database->conn->prepare($sqlQuery_CVHT);
        $stmt_CVHT->bindParam(1, $obj_CVHT->maCoVanHocTap);
        $stmt_CVHT->bindParam(2, $obj_CVHT->matKhauTaiKhoanCoVan);
        $stmt_CVHT->execute();
        $dataRow_CVHT = $stmt_CVHT->fetch(PDO::FETCH_ASSOC);
    
        if ($dataRow_CVHT != null){
            $obj_CVHT->maCoVanHocTap = $dataRow_CVHT['maCoVanHocTap'];
            $obj_CVHT->hoTenCoVan = $dataRow_CVHT['hoTenCoVan'];
            $obj_CVHT->soDienThoai = $dataRow_CVHT['soDienThoai'];
            $obj_CVHT->quyen = $dataRow_CVHT['quyen'];

            $jwt = create_token("cvht",$obj_CVHT,"maCoVanHocTap","hoTenCoVan", "quyen");

            //Them phien dang nhap vao table user_token
            $objUserToken = new UserToken($db);
            $objUserToken->maSo = $obj_CVHT->maCoVanHocTap;
            $objUserToken->token = $jwt;
            $objUserToken->quyen = $obj_CVHT->quyen;
            $objUserToken->thoiGianDangNhap = date("Y-m-d H:i:s");
            $objUserToken->thoiGianHetHan = date("Y-m-d H:i:s", strtotime('+24 hours')); 

            if ($objUserToken->checkUserExist($objUserToken->maSo)){
                $objUserToken->deleteUserToken($objUserToken->maSo);
            }
            
            $objUserToken->createUserToken();

            $arr = array( 
                "maSo" =>  $obj_CVHT->maCoVanHocTap,
                "hoTen" => $obj_CVHT->hoTenCoVan,
                "quyen" => $obj_CVHT->quyen,
            );


            echo json_encode(array(
                "login_status"=> 1,
                "jwt"=> $jwt,
                "message"=>"Login successful",
                $arr
            )); 
            
            return true;
        }


        //Khoa
        $obj_Khoa = new Khoa($db);
        $obj_Khoa->taiKhoanKhoa = $taiKhoan;
        $obj_Khoa->matKhauKhoa = md5($matKhau);  

        $sqlQuery_Khoa = "SELECT * FROM khoa 
                     WHERE taiKhoanKhoa = ? AND matKhauKhoa = ?  LIMIT 0,1";
        $stmt_Khoa = $database->conn->prepare($sqlQuery_Khoa);
        $stmt_Khoa->bindParam(1, $obj_Khoa->taiKhoanKhoa);
        $stmt_Khoa->bindParam(2, $obj_Khoa->matKhauKhoa);
        $stmt_Khoa->execute();
        $dataRow_Khoa = $stmt_Khoa->fetch(PDO::FETCH_ASSOC);
    
        if ($dataRow_Khoa != null){
            $obj_Khoa->maKhoa = $dataRow_Khoa['maKhoa'];
            $obj_Khoa->tenKhoa = $dataRow_Khoa['tenKhoa'];
            $obj_Khoa->taiKhoanKhoa = $dataRow_Khoa['taiKhoanKhoa'];
            $obj_Khoa->matKhauKhoa = $dataRow_Khoa['matKhauKhoa'];
            $obj_Khoa->quyen = $dataRow_Khoa['quyen'];

            $jwt =  create_token("khoa",$obj_Khoa,"taiKhoanKhoa","tenKhoa","quyen");

            //Them phien dang nhap vao table user_token
            $objUserToken = new UserToken($db);
            $objUserToken->maSo = $obj_Khoa->maKhoa;
            $objUserToken->token = $jwt;
            $objUserToken->quyen = $obj_Khoa->quyen;
            $objUserToken->thoiGianDangNhap = date("Y-m-d H:i:s");
            $objUserToken->thoiGianHetHan = date("Y-m-d H:i:s", strtotime('+24 hours')); 

            if ($objUserToken->checkUserExist($objUserToken->maSo)){
                $objUserToken->deleteUserToken($objUserToken->maSo);
            }

            $objUserToken->createUserToken();

            $arr = array( 
                "maSo" =>  $obj_Khoa->maKhoa,
                "hoTen" => $obj_Khoa->tenKhoa,
                "quyen" => $obj_Khoa->quyen
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


    
    
?>