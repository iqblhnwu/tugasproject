<?php
session_start();

include '../config/config.php';

$cek = trim($_POST['vcek']);
if($cek == 'edithero'){
    $max_image_height = 250;
    $max_image_width = 250;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/user/";
    $jpeg_quality = 90;
    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $esesi = $_POST['esesi'];
        $enama = $_POST['enama'];
        $eteks = $_POST['eteks'];
        $savePic = "";

        if(isset($_FILES['fileFoto']) && is_uploaded_file($_FILES['fileFoto']['tmp_name'])){
            $image_name = $_FILES['fileFoto']['name'];
            $image_size = $_FILES['fileFoto']['size'];
            $image_temp = $_FILES['fileFoto']['tmp_name'];

            if($image_size > 512000){
                $image_size = konversi($image_size);
                die("File Gambar Anda Terlalu Besar ! !");
            }

            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan Anda Mengunggah File Gambar ! !");
            }

            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                    break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
                    break;
                case 'image/jpeg':
                case 'image/jpg':
                    $image_res = imagecreatefromjpeg($image_temp);
                    break;
                default:
                    $image_res = false;        
            }
            if($image_res){
                $image_info = pathinfo($image_name);
                $image_extension = strtolower($image_info["extension"]);
                $image_name_only = strtolower($image_info["filename"]);
                $ranKar = random(5);
                $new_file_name = 'User-' . $ranKar . '-' . $esesi . '.' . $image_extension;
                
                $namaGambar = "";
                $fotodb = "SELECT foto FROM portdata WHERE `sesi` = '" . $esesi ."'";
                $fotoquery = mysqli_query($koneksi,$fotodb);
                while($dataf = mysqli_fetch_array($fotoquery)){
                    $namaGambar = $dataf['foto'];
                }
                if(file_exists($destination_folder . $namaGambar)){
                    if($namaGambar != "nopict.png"){
                        unlink($destination_folder . $namaGambar);
                    }
                }
                $image_save_folder = $destination_folder . $new_file_name;

                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $sql = "UPDATE portdata SET `foto` = '" . $new_file_name . "', `namaleng` = '" . $enama . "', `txthero` = '" . $eteks . "' WHERE `sesi` = '" . $esesi . "'";
                    $query = mysqli_query($koneksi,$sql);
                    if($query){
                        echo "ok";
                    }
                }
                imagedestroy($image_res);               
            }
        }
    }
    
    
    $sql = "UPDATE `portdata` SET `namaleng` = '$enama', `txthero` = '$eteks' WHERE sesi = '$esesi'";
    $query = mysqli_query($koneksi, $sql);
    if($query){
        echo "ok";
    }else{
        echo $sql;
    }
}else if($cek == 'delpict'){
    $sqldel = "SELECT * FROM portdata WHERE `sesi` = 'Owner'";
    $querydel = mysqli_query($koneksi,$sqldel);
    if($querydel){
        $data = mysqli_fetch_assoc($querydel);
        $pic = $data['foto'];
        if($pic != 'nopict.jpg'){
            unlink("../asset/img/user/" . $pic);
        }
        $upict = 'nopict.jpg';
        $update = mysqli_query($koneksi,"UPDATE portdata SET `foto` = '" . $upict . "' WHERE `sesi` = 'Owner'");
        if($update){
            
            echo "ok";
        }
    }
}else if($cek == 'eabout'){
    $esesi = $_POST['esesi'];
    $etxt1 = $_POST['etxt1'];
    $etxt2 = $_POST['etxt2'];

    $sql = "UPDATE `portdata` SET `txtabout1`='$etxt1',`txtabout2`='$etxt2' WHERE `sesi`='$esesi'";
    $query = mysqli_query($koneksi,$sql);
    if($query){
        echo 'ok';
    }else{
        echo $sql;
    }
}else if($cek == 'addpjk'){
    $max_image_height = 250;
    $max_image_width = 400;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/projek/";
    $jpeg_quality = 90;

    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $sesi = $_POST['esesi'];
        $judul = $_POST['ejudul'];
        $deskrip = $_POST['eteks'];
        $savePic = "";

        if(isset($_FILES['fileFoto']) && is_uploaded_file($_FILES['fileFoto']['tmp_name'])){
            $image_name = $_FILES['fileFoto']['name'];
            $image_size = $_FILES['fileFoto']['size'];
            $image_temp = $_FILES['fileFoto']['tmp_name'];
            if($image_size > 512000){
                $image_size = konversi($image_size);
                die("File Gambar Anda Terlalu Besar ! !");
            }
            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan Anda Mengunggah File Gambar ! !");
            }
            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                    break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
                    break;
                case 'image/jpeg':
                case 'image/jpg':
                    $image_res = imagecreatefromjpeg($image_temp);
                    break;
                default:
                    $image_res = false;        
            }
            if($image_res){
                $image_info = pathinfo($image_name);
                $image_extension = strtolower($image_info["extension"]);
                $image_name_only = strtolower($image_info["filename"]);
                $ranKar = random(5);
                $new_file_name = 'PJ-' . $ranKar . '-' . $sesi . '.' . $image_extension;
                
                $image_save_folder = $destination_folder . $new_file_name;

                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $savePic = "exist";
                }
                imagedestroy($image_res);
            }
        }
        if($savePic == "exist"){
            $pic = $new_file_name;
        }else{
            $pic = "nopict.jpg";
        }
        $sql = "INSERT INTO projek (gambar, title, txt, sesi) VALUES ('". $pic ."','". $judul ."','" . $deskrip . "', '" . $sesi . "')";
        $query = mysqli_query($koneksi,$sql);

        if($query){
            echo "ok";
        }else{
            echo "$query";
        }
    }
}else if($cek == 'ubahpjk'){
    $max_image_height = 250;
    $max_image_width = 400;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/projek/";
    $jpeg_quality = 90;
    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $esesi = $_POST['esesi'];
        $idpj = $_POST['eid'];
        $ujudul = $_POST['ejudul'];
        $udesk = $_POST['eteks'];
        $savePic = "";

        if(isset($_FILES['fileFoto']) && is_uploaded_file($_FILES['fileFoto']['tmp_name'])){
            $image_name = $_FILES['fileFoto']['name'];
            $image_size = $_FILES['fileFoto']['size'];
            $image_temp = $_FILES['fileFoto']['tmp_name'];
            if($image_size > 512000){
                $image_size = konversi($image_size);
                die("File Gambar Anda Terlalu Besar ! !");
            }
            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan Anda Mengunggah File Gambar ! !");
            }
            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                    break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
                    break;
                case 'image/jpeg':
                case 'image/jpg':
                    $image_res = imagecreatefromjpeg($image_temp);
                    break;
                default:
                    $image_res = false;        
            }
            if($image_res){
                $image_info = pathinfo($image_name);
                $image_extension = strtolower($image_info["extension"]);
                $image_name_only = strtolower($image_info["filename"]);
                $ranKar = random(5);
                $new_file_name = 'PJ-' . $ranKar . '-' . $esesi . '.' . $image_extension;
                
                $namaGambar = "";
                $fotodb = "SELECT gambar FROM projek WHERE `id` = '" . $idpj ."'";
                $fotoquery = mysqli_query($koneksi,$fotodb);
                while($dataf = mysqli_fetch_array($fotoquery)){
                    $namaGambar = $dataf['gambar'];
                }
                if(file_exists($destination_folder . $namaGambar)){
                    if($namaGambar != "nopict.jpg"){
                        unlink($destination_folder . $namaGambar);
                    }
                }
                $image_save_folder = $destination_folder . $new_file_name;

                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $savePic = "exist";
                }
                imagedestroy($image_res);
            }
        }
        if($savePic == "exist"){
            $pic = $new_file_name;
            $sql = "UPDATE projek SET `gambar` = '" . $pic . "', `title` = '" . $ujudul . "', `txt` = '" . $udesk . "' WHERE `id` = '" . $idpj . "'";
            $query = mysqli_query($koneksi,$sql);
            if($query){
                echo "ok";
            }
        }
        $sql = "UPDATE projek SET `title` = '" . $ujudul . "', `txt` = '" . $udesk . "' WHERE `id` = '" . $idpj . "'";
        $query = mysqli_query($koneksi,$sql);
        if($query){
            echo "ok";
        }
    }
    
}else if($cek == 'delpj'){
    $hid = trim($_POST['id']);
    $sqlc = "SELECT gambar FROM projek WHERE `id` = '" . $hid . "'";
    $queryc = mysqli_query($koneksi,$sqlc);
    while($datac = mysqli_fetch_assoc($queryc)){
        $gambarC = $datac['gambar'];
    }
    if($gambarC != "nopict.jpg"){
        unlink('../asset/img/projek/' . $gambarC);
    }
    $sqld = "DELETE FROM projek WHERE `id` = '" . $hid . "'";
    $queryd = mysqli_query($koneksi,$sqld);
    if($queryd){
        echo 'ok';
    }

}else if($cek == 'addkoleksi'){
    $max_image_height = 200;
    $max_image_width = 250;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/koleksi/";
    $jpeg_quality = 90;

    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $sesi = $_POST['esesi'];
        $judul = $_POST['ejudul'];
        $deskrip = $_POST['eteks'];
        $savePic = "";

        if(isset($_FILES['fileFoto']) && is_uploaded_file($_FILES['fileFoto']['tmp_name'])){
            $image_name = $_FILES['fileFoto']['name'];
            $image_size = $_FILES['fileFoto']['size'];
            $image_temp = $_FILES['fileFoto']['tmp_name'];
            if($image_size > 512000){
                $image_size = konversi($image_size);
                die("File Gambar Anda Terlalu Besar ! !");
            }
            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan Anda Mengunggah File Gambar ! !");
            }
            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                    break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
                    break;
                case 'image/jpeg':
                case 'image/jpg':
                    $image_res = imagecreatefromjpeg($image_temp);
                    break;
                default:
                    $image_res = false;        
            }
            if($image_res){
                $image_info = pathinfo($image_name);
                $image_extension = strtolower($image_info["extension"]);
                $image_name_only = strtolower($image_info["filename"]);
                $ranKar = random(5);
                $new_file_name = 'K-' . $ranKar . '-' . $sesi . '.' . $image_extension;
                
                $image_save_folder = $destination_folder . $new_file_name;

                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $savePic = "exist";
                }
                imagedestroy($image_res);
            }
        }
        if($savePic == "exist"){
            $pic = $new_file_name;
        }else{
            $pic = "nopict.jpg";
        }
        $sql = "INSERT INTO koleksi (foto, nama, deskrip, sesi) VALUES ('". $pic ."','". $judul ."','" . $deskrip . "', '" . $sesi . "')";
        $query = mysqli_query($koneksi,$sql);

        if($query){
            echo "ok";
        }else{
            echo "$query";
        }
    }
}else if($cek == 'deleteK'){
    $hid = trim($_POST['id']);
    $sqlc = "SELECT foto FROM koleksi WHERE `id` = '" . $hid . "'";
    $queryc = mysqli_query($koneksi,$sqlc);
    while($datac = mysqli_fetch_assoc($queryc)){
        $gambarC = $datac['foto'];
    }
    if($gambarC != "nopict.jpg"){
        unlink('../asset/img/koleksi/' . $gambarC);
    }
    $sqld = "DELETE FROM koleksi WHERE `id` = '" . $hid . "'";
    $queryd = mysqli_query($koneksi,$sqld);
    if($queryd){
        echo 'ok';
    }
}else if($cek == 'editK'){
    $max_image_height = 200;
    $max_image_width = 250;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/koleksi/";
    $jpeg_quality = 90;
    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $esesi = $_POST['esesi'];
        $idpj = $_POST['eid'];
        $ujudul = $_POST['ejudul'];
        $udesk = $_POST['eteks'];
        $savePic = "";

        if(isset($_FILES['fileFoto']) && is_uploaded_file($_FILES['fileFoto']['tmp_name'])){
            $image_name = $_FILES['fileFoto']['name'];
            $image_size = $_FILES['fileFoto']['size'];
            $image_temp = $_FILES['fileFoto']['tmp_name'];
            if($image_size > 512000){
                $image_size = konversi($image_size);
                die("File Gambar Anda Terlalu Besar ! !");
            }
            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan Anda Mengunggah File Gambar ! !");
            }
            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                    break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
                    break;
                case 'image/jpeg':
                case 'image/jpg':
                    $image_res = imagecreatefromjpeg($image_temp);
                    break;
                default:
                    $image_res = false;        
            }
            if($image_res){
                $image_info = pathinfo($image_name);
                $image_extension = strtolower($image_info["extension"]);
                $image_name_only = strtolower($image_info["filename"]);
                $ranKar = random(5);
                $new_file_name = 'K-' . $ranKar . '-' . $esesi . '.' . $image_extension;
                
                $namaGambar = "";
                $fotodb = "SELECT foto FROM koleksi WHERE `id` = '" . $idpj ."'";
                $fotoquery = mysqli_query($koneksi,$fotodb);
                while($dataf = mysqli_fetch_array($fotoquery)){
                    $namaGambar = $dataf['foto'];
                }
                if(file_exists($destination_folder . $namaGambar)){
                    if($namaGambar != "nopict.jpg"){
                        unlink($destination_folder . $namaGambar);
                    }
                }
                $image_save_folder = $destination_folder . $new_file_name;

                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $savePic = "exist";
                }
                imagedestroy($image_res);
            }
        }
        if($savePic == "exist"){
            $pic = $new_file_name;
            $sql = "UPDATE koleksi SET `foto` = '" . $pic . "', `nama` = '" . $ujudul . "', `deskrip` = '" . $udesk . "' WHERE `id` = '" . $idpj . "'";
            $query = mysqli_query($koneksi,$sql);
            if($query){
                echo "ok";
            }
        }
        $sql = "UPDATE koleksi SET `nama` = '" . $ujudul . "', `deskrip` = '" . $udesk . "' WHERE `id` = '" . $idpj . "'";
        $query = mysqli_query($koneksi,$sql);
        if($query){
            echo "ok";
        }
    }
}



function save_image($source, $destination, $image_type, $quality)
{
    switch (strtolower($image_type)) { //determine mime type
        case 'image/png':
            imagepng($source, $destination);
            return true; //save png file
            break;
        case 'image/gif':
            imagegif($source, $destination);
            return true; //save gif file
            break;
        case 'image/jpeg':
        case 'image/jpg':
            imagejpeg($source, $destination, $quality);
            return true; //save jpeg file
            break;
        default:
            return false;
    }
}



function konversi($var)
{
    $hasil = 0;
    $hitung = 0;
    $car = mb_strlen($var);
    if ($car >= 4 && $car < 7) {
        $jum = '1024';
        $sat = 'KB';
    } elseif ($car >= 7 && $car < 10) {
        $jum = '1024000';
        $sat = 'MB';
    } elseif ($car >= 10) {
        $jum = '1024000000';
        $sat = 'GB';
    } else {
        $jum = '1';
        $sat = 'bytes';
    }

    $hitung = round($var / $jum, 2);
    $hasil = '' . $hitung . ' ' . $sat . '';

    return $hasil;
}

function random($panjang_karakter)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $panjang_karakter; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos];
    }
    return $string;
}

function normal_resize_image($source, $destination, $image_type, $max_width, $max_height, $image_width, $image_height, $quality)
{

    if ($image_width <= 0 || $image_height <= 0) {
        return false;
    } //return false if nothing to resize

    //resize if image is NOT EXACT EQUAL with max size
    if ($image_width == $max_width && $image_height == $max_height) {
        if (save_image($source, $destination, $image_type, $quality)) {
            return true;
        }
    } else {
        $new_width = $max_width;
        $new_height    = $max_height;

        $new_canvas        = imagecreatetruecolor($new_width, $new_height); //Create a new true color image

        if (imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)) {
            save_image($new_canvas, $destination, $image_type, $quality); //save resized image
        }
    }
    return true;
}