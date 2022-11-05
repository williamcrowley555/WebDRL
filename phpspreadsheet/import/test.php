<?php 
    require '../../helper/validator.php';
    $errorMsg = isPhoneNumber("aklfjaklsdjqwe");
    
    // echo getSinhVienTheoMSSV("3117419997", true);
    $temp = "Đã tốt nghiệp";
    $totNghiep = ($temp === "Chưa tốt nghiệp") ? "0"
    : ($temp === "Đã tốt nghiệp" ? "1" : $temp);

    echo "Tot nghiep: ". $totNghiep ."<br>";
    echo "Tinh trang tot nghiep:". isGraduateTest($totNghiep);

    function getSinhVienTheoMSSV($mssv, $isEqual = true) {
        $db_table = "diemtrungbinhhe4";
        $sqlQuery = "SELECT ". $db_table . ".* FROM " . $db_table . " 
                         INNER JOIN `sinhvien` ON ".
                        $db_table .".maSinhVien = sinhvien.maSinhVien ".
                        "WHERE ". $db_table .".maSinhVien" . 
                        ($isEqual ? " = '$mssv'" : " LIKE '%$mssv%'");
        return $sqlQuery;
    }

    function isGraduateTest($value, $message = null) {
        return ($value === "0" || $value === "1") ? null : $message ?? "Tốt nghiệp không hợp lệ";
    }
?>