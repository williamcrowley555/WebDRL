<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/phieurenluyen.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';


    $read_data = new read_data();
    $data = $read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if ($data["status"] == 1) {
        //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();

            $item = new PhieuRenLuyen($db); //new Khoa object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 


            $fileName = $_FILES['fileDinhKem']['name'];
            $tempPath = $_FILES['fileDinhKem']['tmp_name'];
            $fileSize = $_FILES['fileDinhKem']['size'];


            //Nếu không có file đính kèm thì chạy code này, ngược lại thì chạy code ở else
            if (empty($fileName)){
                if (isset($_POST['maPhieuRenLuyen']) && isset($_POST['maSinhVien']) &&
                    isset($_POST['diemTrungBinhChungHKTruoc']) && isset($_POST['diemTrungBinhChungHKXet']) 
                    && isset($_POST['maHocKyDanhGia']) && isset($_POST['diemTongCong'])){

                    //set các biến bằng data nhận từ user
                    $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
                    $item->xepLoai = null;
                    $item->diemTongCong = $_POST['diemTongCong'];
                    $item->maSinhVien = $_POST['maSinhVien'];
                    $item->diemTrungBinhChungHKTruoc = $_POST['diemTrungBinhChungHKTruoc'];
                    $item->diemTrungBinhChungHKXet = $_POST['diemTrungBinhChungHKXet'];
                    $item->maHocKyDanhGia = $_POST['maHocKyDanhGia'];
                    $item->coVanDuyet = null;
                    $item->khoaDuyet = null;
                    $item->fileDinhKem = null;
        
                        
                    if ($item->createPhieuRenLuyen()) {
                        http_response_code(200);
                        echo json_encode(array(
                            "message"=>"phieurenluyen created successful"
                        ));
                    } else {
                        echo json_encode(array(
                            "message"=>"phieurenluyen could not be created."
                        ));
                    }
        
                } else {
                    echo json_encode(
                        array("message" => "No data posted!")
                    );
                }
            }else{
                $upload_path = 'upload/';

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // lấy phần mở rộng (đuôi file)

                $valid_extensions = array('zip','rar');

                if (in_array($fileExt, $valid_extensions)){
                    if (!file_exists($upload_path.$fileName)){ //check file có tồn tại trong folder upload chưa
                        
                        //fileSize nhỏ hơn 10MB
                        if ($fileSize < 10000000){
                           
                            if (isset($_POST['maPhieuRenLuyen']) && isset($_POST['maSinhVien']) &&
                                isset($_POST['diemTrungBinhChungHKTruoc']) && isset($_POST['diemTrungBinhChungHKXet']) 
                                && isset($_POST['maHocKyDanhGia']) && isset($_POST['diemTongCong'])){

                                //set các biến bằng data nhận từ user
                                $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
                                $item->xepLoai = null;
                                $item->diemTongCong = $_POST['diemTongCong'];
                                $item->maSinhVien = $_POST['maSinhVien'];
                                $item->diemTrungBinhChungHKTruoc = $_POST['diemTrungBinhChungHKTruoc'];
                                $item->diemTrungBinhChungHKXet = $_POST['diemTrungBinhChungHKXet'];
                                $item->maHocKyDanhGia = $_POST['maHocKyDanhGia'];
                                $item->coVanDuyet = null;
                                $item->khoaDuyet = null;
                                $item->fileDinhKem = $fileName;
                    
                                if ($item->createPhieuRenLuyen()) {

                                    move_uploaded_file($tempPath, $upload_path.$fileName);

                                    http_response_code(200);
                                    echo json_encode(array(
                                        "message"=>"phieurenluyen created successful"
                                    ));
                                } else {
                                    echo json_encode(array(
                                        "message"=>"phieurenluyen could not be created."
                                    ));
                                }
                    
                            } else {
                                echo json_encode(
                                    array("message" => "No data posted!")
                                );
                            }


                        }else{
                            echo json_encode(
                                array("message" => "File quá lớn, chỉ chấp nhận file nhỏ hơn 10MB")
                            );
                        }


                    }else{
                        echo json_encode(
                            array("message" => "File đã tồn tại trên server")
                        );
                    }

                }else{
                    echo json_encode(
                        array("message" => "Chỉ chấp nhận file định dạng .zip, .rar")
                    );
                }


            }

            

        // } else {
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>
