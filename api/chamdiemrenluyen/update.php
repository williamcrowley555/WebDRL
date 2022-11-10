<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/chamdiemrenluyen.php';
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

            $item = new ChamDiemRenLuyen($db);

            $data = json_decode(file_get_contents("php://input"));

            if (isset($_FILES['fileMinhChung'])){
                $fileName = $_FILES['fileMinhChung']['name'];
                $tempPath = $_FILES['fileMinhChung']['tmp_name'];
                $fileSize = $_FILES['fileMinhChung']['size'];
            }

            //Nếu không có file đính kèm thì chạy code này, ngược lại thì chạy code ở else
            if (empty($fileName)){

                if (isset($_POST['maPhieuRenLuyen']) && isset($_POST['maTieuChi3']) &&
                    isset($_POST['maTieuChi2']) && isset($_POST['maSinhVien']) 
                    && isset($_POST['diemSinhVienDanhGia']) && isset($_POST['diemLopDanhGia'])
                    && isset($_POST['diemKhoaDanhGia']) && isset($_POST['ghiChu']) && isset($_POST['maChamDiemRenLuyen'])  ){

                    //set các biến bằng data nhận từ user
                    $item->maChamDiemRenLuyen = $_POST['maChamDiemRenLuyen'];
                    $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
                    $item->maTieuChi3 = $_POST['maTieuChi3'];
                    $item->maTieuChi2 = $_POST['maTieuChi2'];
                    $item->maSinhVien = $_POST['maSinhVien'];
                    $item->diemSinhVienDanhGia = $_POST['diemSinhVienDanhGia'];
                    $item->diemLopDanhGia = $_POST['diemLopDanhGia'];
                    $item->diemKhoaDanhGia = $_POST['diemKhoaDanhGia'];
                    $item->ghiChu = $_POST['ghiChu'];
        
                        
                    if ($item->updateChamDiemRenLuyen()) {
                        http_response_code(200);
                        echo json_encode(
                            array("message" => "chamdiemrenluyen cập nhật thành công.")
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array("message" => "chamdiemrenluyen cập nhật thất bại.")
                        );
                    }
        
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không có dữ liệu được gửi lên.")
                    );
                }

            }else{

                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // lấy phần mở rộng (đuôi file)

                $valid_extensions = array('png','jpg','jpeg');

                if (in_array($fileExt, $valid_extensions)){

                    //fileSize nhỏ hơn 10MB
                    if ($fileSize < 10000000){
                           
                        if (isset($_POST['maPhieuRenLuyen']) && isset($_POST['maTieuChi3']) &&
                            isset($_POST['maTieuChi2']) && isset($_POST['maSinhVien']) 
                            && isset($_POST['diemSinhVienDanhGia']) && isset($_POST['diemLopDanhGia'])
                            && isset($_POST['diemKhoaDanhGia']) && isset($_POST['ghiChu'])  && isset($_POST['maChamDiemRenLuyen']) ){

                            //set các biến bằng data nhận từ user
                            $item->maChamDiemRenLuyen = $_POST['maChamDiemRenLuyen'];
                            $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
                            $item->maTieuChi3 = $_POST['maTieuChi3'];
                            $item->maTieuChi2 = $_POST['maTieuChi2'];
                            $item->maSinhVien = $_POST['maSinhVien'];
                            $item->diemSinhVienDanhGia = $_POST['diemSinhVienDanhGia'];
                            $item->diemLopDanhGia = $_POST['diemLopDanhGia'];
                            $item->diemKhoaDanhGia = $_POST['diemKhoaDanhGia'];
                            $item->fileMinhChung = $fileName;
                            $item->ghiChu = $_POST['ghiChu'];
                
                            if ($item->maTieuChi3 != 0){
                                $upload_path = './upload/'.$item->maPhieuRenLuyen.'/tieuchi3_'.$item->maTieuChi3.'/';
                            }

                            if ($item->maTieuChi2 != 0){
                                $upload_path = './upload/'.$item->maPhieuRenLuyen.'/tieuchi2_'.$item->maTieuChi2.'/';
                            }

                           
                            if (!is_dir($upload_path)){ //check folder có tồn tại trong folder upload chưa
                                mkdir($upload_path, 0777, true); //tạo folder chứa file của user nếu chưa có
                            
                                if (!file_exists($upload_path.$fileName)){
                                    if ($item->updateChamDiemRenLuyen_WithFile()) {

                                        move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                        http_response_code(200);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật thành công"
                                        ));
                                    } else {
                                        http_response_code(404);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật KHÔNG thành công."
                                        ));
                                    }
                                }else{
                                    unlink($upload_path.$fileName);
                                    if ($item->updateChamDiemRenLuyen_WithFile()) {

                                        move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                        http_response_code(200);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật thành công"
                                        ));
                                    } else {
                                        http_response_code(404);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật KHÔNG thành công."
                                        ));
                                    }
                                    // echo json_encode(array(
                                    //     "message"=>"File đã tồn tại trên server."
                                    // ));
                                }
                            }else{
                                if (!file_exists($upload_path.$fileName)){
                                    if ($item->updateChamDiemRenLuyen_WithFile()) {

                                        move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                        http_response_code(200);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật thành công"
                                        ));
                                    } else {
                                        http_response_code(500);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật KHÔNG thành công."
                                        ));
                                    }
                                }else{
                                    unlink($upload_path.$fileName);
                                    if ($item->updateChamDiemRenLuyen_WithFile()) {

                                        move_uploaded_file($tempPath, $upload_path.$fileName);
    
                                        http_response_code(200);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật thành công"
                                        ));
                                    } else {
                                        http_response_code(500);
                                        echo json_encode(array(
                                            "message" => "chamdiemrenluyen cập nhật KHÔNG thành công."
                                        ));
                                    }
                                    // http_response_code(500);
                                    //     echo json_encode(array(
                                    //     "message"=>"File đã tồn tại trên server."
                                    // ));
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