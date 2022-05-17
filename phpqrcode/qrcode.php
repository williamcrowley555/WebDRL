<?php
    include 'qrlib.php';

class qrcode1{
   // truyền vào url tạo qrcode
    public static function create_QRcode($url){

        $path = __DIR__.'/images/';
        $name_img = uniqid(). ".png";
        $file = $path .  $name_img ;
        $ecc = "L";
        $pixel_Size = 10;
        $frame_Size = 10;
        
        QRcode::png($url, $file, $ecc, $pixel_Size, $frame_Size);
        return   $name_img;
    }
   
}

?>