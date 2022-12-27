<?php

    function remove_accents($str) {
        $unicode = array(
 
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
             
            'd'=>'đ',
             
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
             
            'i'=>'í|ì|ỉ|ĩ|ị',
             
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
             
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
             
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
             
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
             
            'D'=>'Đ',
             
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
             
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
             
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
             
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
             
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
             
        );
             
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        
        return $str;
    }

    function isRequired($value, $message = null) {
        return $value ? null : $message ?? "Vui lòng nhập trường này";
    }

    function minLength($value, $min, $message = null) {
        return strlen($value) >= $min ? null : $message ?? "Vui lòng nhập tối thiểu $min ký tự";
    }

    function exactLength($value, $exact, $message = null) {
        return strlen($value) == $exact ? null : $message ?? "Vui lòng nhập đủ $exact ký tự";
    }

    function isNumber($value, $message = null) {
        return is_numeric($value) ? null : $message ?? "Trường này chỉ bao gồm các ký tự số";
    }

    function isPositiveNumber($value, $message = null) {
        return (is_numeric($value) && (float) $value> 0) ? null : $message ?? "Trường này phải là số dương";
    }

    function isCharacters($value, $hasWhiteSpace = true, $message = null) {
        $regexWithWhiteSpace = "/^[A-Za-z\s]+$/";
        $regexWithoutWhiteSpace = "/^[A-Za-z]+$/";

        $regex = $regexWithWhiteSpace;

        if (!$hasWhiteSpace) $regex = $regexWithoutWhiteSpace;

        return preg_match($regex, remove_accents($value))
            ? null
            : $message ??
                "Trường này chỉ bao gồm các ký tự chữ và " . 
                ($hasWhiteSpace ? "khoảng trắng" : "không bao gồm khoảng trắng");
    }

    function isNotSpecialChars($value, $hasWhiteSpace = true, $message = null) {
        $regexWithWhiteSpace = "/^[A-Za-z0-9\s]+$/";
        $regexWithoutWhiteSpace = "/^[A-Za-z0-9]+$/";

        $regex = $regexWithWhiteSpace;

        if (!$hasWhiteSpace) $regex = $regexWithoutWhiteSpace;

        return preg_match($regex, $value)
            ? null
            : $message ??
                "Trường này chỉ bao gồm các ký tự chữ, số và " . 
                ($hasWhiteSpace ? "khoảng trắng" : "không bao gồm khoảng trắng");
    }

    function isDateOfBirth($value, $message = null) {
        $today = date("Y-m-d");
      
        return strtotime($value) <= strtotime($today) ? null : $message ?? "Ngày sinh không hợp lệ";
    }

    function isDateFormat($date, $format = 'Y-m-d', $message = null) {
        $d = DateTime::createFromFormat($format, $date);
        
        return $d && $d->format($format) === $date ? null : $message ?? "Ngày nhập vào phải theo định dạng $format";
    }

    function isPhoneNumber($value, $message = null) {
        $regex = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,5}$/im";

        return preg_match($regex, $value) ? null : $message ?? "Số điện thoại không hợp lệ";
    }

    function isEmail($value, $message = null) {
        $regex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        return preg_match($regex, $value) ? null : $message ?? "Email không hợp lệ";
    }

    function isGraduate($value, $message = null) {
        return ($value === "Chưa tốt nghiệp" || $value === "Đã tốt nghiệp") ? null : $message ?? "Tốt nghiệp không hợp lệ";
    }

    function isGPA($value, $message = null) {
        return ($value >= 0 && $value <= 4) ? null : $message ?? "Điểm không hợp lệ";
    }

    function isGPAIDFormat($value, $maSinhVien, $maHocKyDanhGia, $message = null) {
        return ($value == ($maSinhVien."".$maHocKyDanhGia)) ? null : $message ?? "Mã điểm trung bình không hợp lệ";
    }

    function isNamHoc ($value , $message = null) {
        $regex = "/^[12][0-9]{3}-[12][0-9]{3}$/";
        return preg_match($regex, $value) ? null : $message ?? "Năm học không hợp lệ";
    }

    function isValidNamHoc ($value, $message = null) {
        $namHocArr = explode("-", $value);
        return ($namHocArr[0] < $namHocArr[1]) ? null : $message ?? "Năm học trước phải nhỏ hơn năm học sau";
    }

    function isHocKy($value, $message = null) {
        return ($value == "1" || $value == "2") ? null : $message ?? "Học kỳ không hợp lệ";
    }
?>