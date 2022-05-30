<?php
    include_once "checkcookie.php";

    if (isset($_POST['jwt'])){
        $jwt = $_POST['jwt'];
        $previousPage = $_POST['previousPage'];

        $dataToken = CheckCookie::read_data_token($jwt);

        $quyen = $dataToken['user_data']->aud;

        switch ($quyen) {
            case 'sinhvien':{
                if (!empty($previousPage)){
                    header("Location: ".$previousPage);
                }
                
                header("Location: ../chamdiem.php");
               
                break;
                
            }
            
            case 'cvht':{
                header("Location: ../cvht_duyetdiemrenluyen.php");
                break;
            }

            case 'khoa':{
                header("Location: ../khoa_duyetdiemrenluyen.php");
                break;
            }
            
            
            default:{
                header("Location: ../dangnhap.php");
                break;
            }
               
        }
    
   

        
    }



?>