<?php
    require "../PHPMailer-master/src/PHPMailer.php"; 
    require "../PHPMailer-master/src/SMTP.php"; 
    require '../PHPMailer-master/src/Exception.php'; 
    include_once '../config.php';
    
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';

    require '../../config/database.php';
    include_once '../../class/hockydanhgia.php';
    include_once '../../class/khieunai.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true:enables exceptions
    $mailConfiguration = new MailConfiguration();

    function IsNullOrEmptyString($str){
        return ($str === null || trim($str) === '');
    }

    if(isset($_POST["maKhieuNai"])) {
        $database = new Database();
        $db = $database->getConnection();

        // Lấy thông tin khiếu nại
        $khieuNai = new KhieuNai($db);

        $khieuNai->getSingleDetailsTheoMaKhieuNai($_POST["maKhieuNai"]);
        $khieuNai_arr = null;
        $hockydanhgia_arr = null;

        if($khieuNai->maPhieuRenLuyen != null) {
            // create array
            $khieuNai_arr = array(
                "maKhieuNai" =>  $khieuNai->maKhieuNai,
                "maPhieuRenLuyen" => $khieuNai->maPhieuRenLuyen,
                "lyDoKhieuNai" => $khieuNai->lyDoKhieuNai,
                "minhChung" => $khieuNai->minhChung,
                "trangThai" => $khieuNai->trangThai,
                "thoiGianKhieuNai" => $khieuNai->thoiGianKhieuNai,
                "loiNhan" => $khieuNai->loiNhan,
                "lyDoTuChoi" => $khieuNai->lyDoTuChoi,
                "maHocKyDanhGia" => $khieuNai->maHocKyDanhGia,
                "maSinhVien" => $khieuNai->maSinhVien,
                "hoTenSinhVien" => $khieuNai->hoTenSinhVien,
                "email" => $khieuNai->email,
                "maLop" => $khieuNai->maLop,
            );

            // Lấy thông tin học kỳ đánh giá
            $hocKyDanhGia = new HocKyDanhGia($db);
            $hocKyDanhGia->maHocKyDanhGia = $khieuNai_arr['maHocKyDanhGia'];
    
            $hocKyDanhGia->getSingleHocKyDanhGia();
            if ($hocKyDanhGia->hocKyXet != null) {
                // create array
                $hockydanhgia_arr = array(
                    "maHocKyDanhGia" =>  $hocKyDanhGia->maHocKyDanhGia,
                    "hocKyXet" => $hocKyDanhGia->hocKyXet,
                    "namHocXet" => $hocKyDanhGia->namHocXet
                );
            }
        }

        if ($khieuNai_arr != null && $hockydanhgia_arr != null) {
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
            $mail->Subject = 'Phản hồi khiếu nại điểm rèn luyện';
            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));

            // Xử lý gửi email 
            try {
                $mail->clearAllRecipients();
                $mail->addAddress($khieuNai_arr['email'], ucwords($khieuNai_arr['hoTenSinhVien'])); // email và tên người nhận  
                $noidungthu = file_get_contents('../mail_content/noiDungPheDuyetKhieuNai.txt');

                $text_trangThai = $khieuNai_arr['trangThai'] == 1 ? 'được chấp thuận' : 'bị từ chối';
                $text_ghiChu = '';

                if ($khieuNai_arr['trangThai'] == 1) {
                    $text_ghiChu = IsNullOrEmptyString($khieuNai_arr['loiNhan']) ? '' : ('Lời nhắn: ' . $khieuNai_arr['loiNhan']);
                } else {
                    $text_ghiChu = IsNullOrEmptyString($khieuNai_arr['lyDoTuChoi']) ? '' : ('Lý do từ chối: ' . $khieuNai_arr['lyDoTuChoi']);
                }

                $noidungthu = str_replace(
                    ['{hocKyXet}', '{namHocXet}', '{hoTenSinhVien}', '{maSinhVien}', '{text_trangThai}', '{text_ghiChu}'],
                    [$hockydanhgia_arr['hocKyXet'], $hockydanhgia_arr['namHocXet'], $khieuNai_arr['hoTenSinhVien'], $khieuNai_arr['maSinhVien'], $text_trangThai, $text_ghiChu],
                    $noidungthu
                );
                $mail->Body = $noidungthu;
        
                $mail->send();
        
                echo json_encode(array('success' => true,
                                    'message' => "Gửi email thông báo phê duyệt khiếu nại thành công!"));
            } catch (Exception $e) {
                echo json_encode(array('success' => false,
                                    'message' => 'Lỗi gửi mail: ' . $mail->ErrorInfo));
            }
        } else {
            echo json_encode(array('success' => false,
                                    'message' => 'Không tìm thấy thông tin của khiếu nại'));
        }
    }
 ?>