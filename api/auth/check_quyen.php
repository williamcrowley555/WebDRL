<?php

class checkQuyen{

    //cvht hoặc khoa hoặc phòng ctsv
    public static function checkQuyen_CVHT_Khoa_CTSV($quyen){
        if ($quyen == "cvht" || $quyen == "khoa" || $quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }

    //khoa hoặc phòng ctsv
    public static function checkQuyen_Khoa_CTSV($quyen){
        if ($quyen == "khoa" || $quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }

    //phòng ctsv
    public static function checkQuyen_CTSV($quyen){
        if ($quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }


}





?>