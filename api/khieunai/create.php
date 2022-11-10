<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khieunai.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        // if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new KhieuNai($db); //new KhieuNai object
            
            $data = json_decode(file_get_contents("php://input"));

            $item->maPhieuRenLuyen = $_POST['maPhieuRenLuyen'];
            $item->lyDoKhieuNai = $_POST['lyDoKhieuNai'];

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $item->thoiGianKhieuNai = date('Y-m-d H:i:s', time());

            // Nếu có upload ảnh minh chứng
            if (isset($_FILES['minhChung'])) {
                $minhChung = "";
                $upload_path = '../../user-images/sinhvien/'. $_POST['maSinhVien'] . '/khieuNai_minhChung/' . $_POST['maHocKy'] . '/';
                $totalFiles = count($_FILES['minhChung']['name']);

                if ($totalFiles > 0) {
                    if (!is_dir($upload_path)){ //check folder có tồn tại trong folder upload chưa
                        mkdir($upload_path, 0777, true); //tạo folder chứa file của user nếu chưa có
                    } else {
                        //Delete all Files in khieuNai_minhChung folder
                        $files = glob($upload_path.'/*'); // get all file names
                        foreach ($files as $file) { // iterate files
                            if(is_file($file)) {
                                unlink($file); // delete file
                            }
                        }
                    }
                }

                for($i = 0 ; $i < $totalFiles ; $i++) {
                    $fileName = $_FILES['minhChung']['name'][$i];
                    $tempPath = $_FILES['minhChung']['tmp_name'][$i];
                    $fileSize = $_FILES['minhChung']['size'][$i];

                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // lấy phần mở rộng (đuôi file)

                    $valid_extensions = array('png','jpg','jpeg');

                    if (in_array($fileExt, $valid_extensions)) {
                        //fileSize nhỏ hơn 10MB
                        if ($fileSize < 10000000 && $tempPath != "") {
                            if(move_uploaded_file($tempPath, $upload_path . $fileName)) {
                                $minhChung .= $fileName . "|";
                            }
                        }
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array("message" => "Chỉ chấp nhận file định dạng .png, .jpg, .jpeg")
                        );
                    }
                }

                $item->minhChung = $minhChung;
            } 

            if ($item->createKhieuNai()) {
                http_response_code(200);
                echo json_encode(array(
                    "message" => "Tạo khiếu nại thành công!"
                ));
            } else {
                //Delete all Files in khieuNai_minhChung folder
                $files = glob($upload_path.'/*'); // get all file names
                foreach ($files as $file) { // iterate files
                    if(is_file($file)) {
                        unlink($file); // delete file
                    }
                }

                http_response_code(404);
                echo json_encode(array(
                    "message" => "Tạo khiếu nại thất bại!"
                ));
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