<?php
  
    $maHocKyDanhGia = 'HK22122';
    $maSinhVien = '3118410018';

    
    $upload_path = './upload/'.$maHocKyDanhGia.'/'.$maSinhVien.'/';

    if (!is_dir($upload_path)){ //check folder có tồn tại trong folder upload chưa
        mkdir($upload_path, 0777, true);
     }


?>