<?php
    require "../PHPMailer-master/src/PHPMailer.php"; 
    require "../PHPMailer-master/src/SMTP.php"; 
    require '../PHPMailer-master/src/Exception.php'; 
    include_once '../config.php';
    
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';

    require '../../config/database.php';
    include_once '../../class/thongbaodanhgia.php';
    include_once '../../class/sinhvien.php';
    include_once '../../class/covanhoctap.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true:enables exceptions
    $mailConfiguration = new MailConfiguration();

    $options = explode(",", $_POST["options"]);

    // Kiểm tra file upload là file excel?
    if (in_array("uploadExcel", $options)) {
        $fileName = $_FILES['email_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    
        $allowed_ext = ['xls','csv','xlsx'];
    
        if(!in_array($file_ext, $allowed_ext)) {
            echo json_encode(array('success' => false,
                                    'message' => 'File upload yêu cầu phải là File Excel!'));
            exit();
        }
    }

    if(!empty($options) && isset($_POST["maThongBao"])) {
        $database = new Database();
        $db = $database->getConnection();

        // Lấy thông tin thông báo đánh giá
        $thongBaoDanhGia = new ThongBaoDanhGia($db);

        $thongBaoDanhGia->maThongBao = $_POST["maThongBao"];

        $thongBaoDanhGia->getSingleDetailsThongBaoDanhGia();
        $thongbaodanhgia_arr = null;
        
        if($thongBaoDanhGia->ngaySinhVienDanhGia != null) {
            // create array
            $thongbaodanhgia_arr = array(
                "maThongBao" =>  $thongBaoDanhGia->maThongBao,
                "ngaySinhVienDanhGia" => $thongBaoDanhGia->ngaySinhVienDanhGia,
                "ngaySinhVienKetThucDanhGia" => $thongBaoDanhGia->ngaySinhVienKetThucDanhGia,
                "ngayCoVanDanhGia" => $thongBaoDanhGia->ngayCoVanDanhGia,
                "ngayCoVanKetThucDanhGia" => $thongBaoDanhGia->ngayCoVanKetThucDanhGia,
                "ngayKhoaDanhGia" => $thongBaoDanhGia->ngayKhoaDanhGia,
                "ngayKhoaKetThucDanhGia" => $thongBaoDanhGia->ngayKhoaKetThucDanhGia,
                "ngayThongBao" => $thongBaoDanhGia->ngayThongBao,
                "maHocKyDanhGia" => $thongBaoDanhGia->maHocKyDanhGia,  
                "hocKyXet" => $thongBaoDanhGia->hocKyXet,
                "namHocXet" => $thongBaoDanhGia->namHocXet,      
            );
        }

        if ($thongbaodanhgia_arr != null) {
            // Set thông số cho PHPMailer
            $mail->SMTPDebug = 0; //0,1,2: chế độ debug. 
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = $mailConfiguration->getUserName(); // SMTP username
            $mail->Password = $mailConfiguration->getPassword();   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom($mailConfiguration->getUserName(), 'Trường đại học Sài Gòn (SGU)' ); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Thông báo thời gian đánh giá điểm rèn luyện';
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));

            // Xử lý gửi email 
            try {
                foreach ($options as $option) {
                    switch ($option) {
                        case "allSinhVien":
                            $sinhVienList = new SinhVien($db);
                            $stmt = $sinhVienList->getAllSinhVienWithEmail(true);
                            $itemCount = $stmt->rowCount();
                    
                            if ($itemCount > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);

                                    $mail->clearAllRecipients();
                                    $mail->addAddress($email, ucwords($hoTenSinhVien)); // email và tên người nhận  
                                    $noidungthu = file_get_contents('../mail_content/noiDungThongBaoDanhGia_sinhVien.txt');
                                    $noidungthu = str_replace(
                                        ['{hocKyXet}', '{namHocXet}', '{hoTenSinhVien}', '{maSinhVien}', '{ngaySinhVienDanhGia}', '{ngaySinhVienKetThucDanhGia}'],
                                        [$thongbaodanhgia_arr['hocKyXet'], $thongbaodanhgia_arr['namHocXet'], $hoTenSinhVien, $maSinhVien, date_format(date_create($thongbaodanhgia_arr['ngaySinhVienDanhGia']), "d/m/Y"), date_format(date_create($thongbaodanhgia_arr['ngaySinhVienKetThucDanhGia']), "d/m/Y")],
                                        $noidungthu
                                    );
                                    $mail->Body = $noidungthu;
                            
                                    $mail->send();
                                }
                            }

                            break;

                        case "allCVHT":
                            $coVanList = new CVHT($db);
                            $stmt = $coVanList->getAllCVHTWithEmail();
                            $itemCount = $stmt->rowCount();
                    
                            if ($itemCount > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);

                                    $mail->clearAllRecipients();
                                    $mail->addAddress($email, ucwords($hoTenCoVan)); // email và tên người nhận  
                                    $noidungthu = file_get_contents('../mail_content/noiDungThongBaoDanhGia_cvht.txt');
                                    $noidungthu = str_replace(
                                        ['{hocKyXet}', '{namHocXet}', '{hoTenCoVan}', '{maCoVanHocTap}', '{ngayCoVanDanhGia}', '{ngayCoVanKetThucDanhGia}'],
                                        [$thongbaodanhgia_arr['hocKyXet'], $thongbaodanhgia_arr['namHocXet'], $hoTenCoVan, $maCoVanHocTap, date_format(date_create($thongbaodanhgia_arr['ngayCoVanDanhGia']), "d/m/Y"), date_format(date_create($thongbaodanhgia_arr['ngayCoVanKetThucDanhGia']), "d/m/Y")],
                                        $noidungthu
                                    );
                                    $mail->Body = $noidungthu;
                            
                                    $mail->send();
                                }
                            }

                            break;

                        case "uploadExcel":
                            $inputFileNamePath = $_FILES['email_file']['tmp_name'];
                            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
                            $rows = $spreadsheet->getActiveSheet()->toArray();
                            $rowCount = 0;
                            $emailColumnIndex = '0';

                            foreach($rows as $row) {
                                // Tìm index cột email ở dòng đầu tiên (table title)
                                if($rowCount == 0) {
                                    for ($i = 0; $i < 10; $i++) {
                                        if (isset($row[(string) $i]) && strtolower($row[(string) $i]) == "email") {
                                            $emailColumnIndex = (string) $i;
                                            break;
                                        }
                                    }
                                } else {
                                    if (isset($row[$emailColumnIndex])) {
                                        // Kiểm tra email hợp lệ
                                        if(($errorMsg = isEmail($row[$emailColumnIndex])) != null) {
                                            continue;
                                        } else {
                                            $mail->clearAllRecipients();
                                            $mail->addAddress($row[$emailColumnIndex], ""); // email và tên người nhận  
                                            $noidungthu = file_get_contents('../mail_content/noiDungThongBaoDanhGia_all.txt');
                                            $noidungthu = str_replace(
                                                ['{hocKyXet}', '{namHocXet}', '{ngaySinhVienDanhGia}', '{ngaySinhVienKetThucDanhGia}', '{ngayCoVanDanhGia}', '{ngayCoVanKetThucDanhGia}', '{ngayKhoaDanhGia}', '{ngayKhoaKetThucDanhGia}'],
                                                [$thongbaodanhgia_arr['hocKyXet'], $thongbaodanhgia_arr['namHocXet'], 
                                                    date_format(date_create($thongbaodanhgia_arr['ngaySinhVienDanhGia']), "d/m/Y"), date_format(date_create($thongbaodanhgia_arr['ngaySinhVienKetThucDanhGia']), "d/m/Y"), 
                                                    date_format(date_create($thongbaodanhgia_arr['ngayCoVanDanhGia']), "d/m/Y"), date_format(date_create($thongbaodanhgia_arr['ngayCoVanKetThucDanhGia']), "d/m/Y"), 
                                                    date_format(date_create($thongbaodanhgia_arr['ngayKhoaDanhGia']), "d/m/Y"), date_format(date_create($thongbaodanhgia_arr['ngayKhoaKetThucDanhGia']), "d/m/Y")],
                                                $noidungthu
                                            );
                                            $mail->Body = $noidungthu;
                                    
                                            $mail->send();
                                        }
                                    }
                                }

                                $rowCount++;
                            }

                            break;
        
                        default:
                            break;
                    }
                }
        
                echo json_encode(array('success' => true,
                                    'message' => "Gửi email thông báo thành công!"));
            } catch (Exception $e) {
                echo json_encode(array('success' => false,
                                    'message' => 'Lỗi gửi mail: ' . $mail->ErrorInfo));
            }
        }
    }
 ?>