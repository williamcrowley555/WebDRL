<?php

class checkQuyen{

    //cvht hoặc khoa hoặc phòng ctsv
    public static function checkQuyen_CVHT_Khoa_CTSV($quyen){
        if ($quyen == "superadmin" || $quyen == "cvht" || $quyen == "khoa" || $quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }
    
    //cvht hoặc khoa hoặc phòng ctsv hoặc admin
    public static function checkQuyen_CVHT_Khoa_CTSV_Admin($quyen){
        if ($quyen == "superadmin" || $quyen == "cvht" || $quyen == "khoa" || $quyen == "phongcongtacsinhvien" || $quyen == "admin"){
            return true;
        }else{
            return false;
        }

    }

    //khoa hoặc phòng ctsv
    public static function checkQuyen_Khoa_CTSV($quyen){
        if ($quyen == "superadmin" || $quyen == "khoa" || $quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }

    //khoa hoặc phòng ctsv hoặc admin
    public static function checkQuyen_Khoa_CTSV_Admin($quyen){
        if ($quyen == "superadmin" || $quyen == "khoa" || $quyen == "phongcongtacsinhvien" || $quyen == "admin"){
            return true;
        }else{
            return false;
        }

    }

    //phòng ctsv
    public static function checkQuyen_CTSV($quyen){
        if ($quyen == "superadmin" || $quyen == "phongcongtacsinhvien"){
            return true;
        }else{
            return false;
        }

    }

    //phòng ctsv hoặc admin
    public static function checkQuyen_CTSV_Admin($quyen){
        if ($quyen == "superadmin" || $quyen == "phongcongtacsinhvien" || $quyen == "admin"){
            return true;
        }else{
            return false;
        }

    }

    //admin
    public static function checkQuyen_Admin($quyen){
        if ($quyen == "superadmin" || $quyen == "admin"){
            return true;
        }else{
            return false;
        }

    }
}
?>