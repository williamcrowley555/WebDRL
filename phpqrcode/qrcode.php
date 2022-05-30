<?php
    include 'qrlib.php';

class qrcode1{
   // truyền vào url tạo qrcode
    public static function create_QRcode($url){

        $path = dirname(__DIR__).'../api/hoatdongdanhgia/QRImages/';
        $name_img = uniqid(). ".png";
        $file = $path .  $name_img ;
        $ecc = "L";
        $pixel_Size = 12;
        $frame_Size = 8;
        
        QRcode::png($url, $file, $ecc, $pixel_Size, $frame_Size);
        return   $name_img;
    }
   
}

?>