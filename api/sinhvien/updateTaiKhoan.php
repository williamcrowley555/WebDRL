<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../../class/covanhoctap.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';


    $read_data = new read_data();
    $data = $read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if ($data["status"] == 1) {
        //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
            
            if(isset($_POST['quyen']))
            {
                if(($_POST['quyen'] == "sinhvien")) {
                    $item = new SinhVien($db);
                } else {
                    $item = new CVHT($db);
                }
            }
            

            $data = json_decode(file_get_contents("php://input"));

            if (isset($_FILES['anhDaiDien'])){
                $fileName = $_FILES['anhDaiDien']['name'];
                $tempPath = $_FILES['anhDaiDien']['tmp_name'];
                $fileSize = $_FILES['anhDaiDien']['size'];
            }

            //Nếu không có file đính kèm thì chạy code này, ngược lại thì chạy code ở else
            if (empty($fileName)){

                if ((isset($_POST['maSinhVien']) || isset($_POST['maCoVanHocTap'])) && isset($_POST['email']) && (isset($_POST['sdt']) || (isset($_POST['soDienThoai'])))){

                    //set các biến bằng data nhận từ user
                    if($_POST['quyen'] == "sinhvien") {
                        $item->maSinhVien = $_POST['maSinhVien'];
                    } else {
                        $item->maCoVanHocTap = $_POST['maCoVanHocTap'];
                    }
                    $item->email = $_POST['email'];
                    if($_POST['quyen'] == "sinhvien") {
                        $item->sdt = $_POST['sdt'];
                    } else {
                        $item->soDienThoai = $_POST['soDienThoai'];
                    }
                    
                        
                    if($_POST['quyen'] == "sinhvien") {
                        if ($item->updateTaiKhoanSinhVien()) {
                            http_response_code(200);
                            echo json_encode(
                                array("message"=>"Cập nhật profile sinhvien thành công!")
                            );
                        } else {
                            http_response_code(404);
                            echo json_encode(
                                array("message"=>"Cập nhật profile KHÔNG thành công!")
                            );
                        }
                    } else {
                        if ($item->updateTaiKhoanCvht()) {
                            http_response_code(200);
                            echo json_encode(
                                array("message"=>"Cập nhật profile cvht thành công!")
                            );
                        } else {
                            http_response_code(404);
                            echo json_encode(
                                array("message"=>"Cập nhật profile KHÔNG thành công!")
                            );
                        }
                    }
                    
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không có dữ liệu được gửi lên 1.")
                    );
                }
            } else {

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // lấy phần mở rộng (đuôi file)

                $valid_extensions = array('png','jpg','jpeg');

                if (in_array($fileExt, $valid_extensions)){

                    //fileSize nhỏ hơn 10MB
                    if ($fileSize < 10000000){
                           
                        if (isset($_POST['maSinhVien']) || isset($_POST['maCoVanHocTap'])) {

                            //set các biến bằng data nhận từ user
                            
                            if($_POST['quyen'] == "sinhvien") {
                                $item->maSinhVien = $_POST['maSinhVien'];
                            } else {
                                $item->maCoVanHocTap = $_POST['maCoVanHocTap'];
                            }
                            $item->email = $_POST['email'];
                            if($_POST['quyen'] == "sinhvien") {
                                $item->sdt = $_POST['sdt'];
                            } else {
                                $item->soDienThoai = $_POST['soDienThoai'];
                            }
                            
                            $item->anhDaiDien = $fileName;

                            if($_POST['quyen'] == "sinhvien") {
                                $upload_path = '../../user-images/sinhvien/'.$item->maSinhVien.'/user-avatar/';
                            } else {
                                $upload_path = '../../user-images/cvht/'.$item->maCoVanHocTap.'/user-avatar/';
                            }
                            


                            if (!is_dir($upload_path)){ //check folder có tồn tại trong folder upload chưa
                                mkdir($upload_path, 0777, true); //tạo folder chứa file của user nếu chưa có
                            }
                            
                            if($_POST['quyen'] == "sinhvien") {
                                if ($item->updateTaiKhoanSinhVien()) {
                                    
                                    //Delete all Files in user-avatar folder
                                    $files = glob($upload_path.'/*'); // get all file names
                                    foreach ($files as $file) { // iterate files
                                        if(is_file($file)) {
                                            unlink($file); // delete file
                                        }
                                    }
                                    
                                    move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                    http_response_code(200);
                                    echo json_encode(array(
                                        "message"=>"Cập nhật profile sinhvien thành công!"
                                    ));
                                } else {
                                    http_response_code(404);
                                    echo json_encode(array(
                                        "message"=>"Cập nhật profile KHÔNG thành công!"
                                    ));
                                }
                            } else {
                                if ($item->updateTaiKhoanCvht()) {
                                    
                                    //Delete all Files in user-avatar folder
                                    $files = glob($upload_path.'/*'); // get all file names
                                    foreach ($files as $file) { // iterate files
                                        if(is_file($file)) {
                                            unlink($file); // delete file
                                        }
                                    }
                                    
                                    move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                    http_response_code(200);
                                    echo json_encode(array(
                                        "message"=>"Cập nhật profile cvht thành công!"
                                    ));
                                } else {
                                    http_response_code(404);
                                    echo json_encode(array(
                                        "message"=>"Cập nhật profile KHÔNG thành công!"
                                    ));
                                }
                            }
                            
                            
                        } else {
                            http_response_code(404);
                            echo json_encode(
                                array("message" => "Không có dữ liệu gửi lên!")
                            );
                        }
                    }else{
                        http_response_code(500);
                        echo json_encode(
                            array("message" => "File quá lớn, chỉ chấp nhận file nhỏ hơn 10MB")
                        );
                    }
                }else{
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "Chỉ chấp nhận file định dạng .png, .jpg, .jpeg")
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