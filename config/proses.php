<?php
session_start();

include 'config.php';

$cek = trim($_POST['vcek']);
if($cek == 'login'){
    $user = addslashes($_POST['vuser']);
    $pass = addslashes($_POST['vpass']);
    
    $sql = "SELECT * FROM login WHERE username = '$user' AND pw = '$pass'";
    $query = mysqli_query($koneksi, $sql);
    
    if($query){
        if(mysqli_num_rows($query) >= 1){
            $logdata = mysqli_fetch_assoc($query);
            $_SESSION['lvl'] = $logdata['sesi'];
            echo "ok";
        }else{
            echo "WRONG ! !";
        }
    }
}else if($cek == 'edithero'){
    $esesi = $_POST['vsesi'];
    $enama = $_POST['vnama'];
    $eteks = $_POST['vteks'];
    
    $sql = "UPDATE `portdata` SET `namaleng` = '$enama', `txthero` = '$eteks' WHERE sesi = '$esesi'";
    $query = mysqli_query($koneksi, $sql);
    if($query){
        echo "Success!";
    }else{
        echo $sql;
    }
}else if($cek == 'editxtabout'){
    $esesi = $_POST['vsesi'];
    $etxt1 = $_POST['vtxt1'];
    $etxt2 = $_POST['vtxt2'];

    $sql = "UPDATE `portdata` SET `txtabout1`='$etxt1',`txtabout2`='$etxt2' WHERE `sesi`='$esesi'";
    $query = mysqli_query($koneksi,$sql);
    if($query){
        echo 'Success!';
    }else{
        echo $sql;
    }
}else if($cek == 'addpict'){
    $max_image_height = 250;
    $max_image_width = 250;
    $thumb_prefix = "thumb_";
    $destination_folder = "../asset/img/user/";
    $jpeg_quality = 90;

    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        $sesi = "Owner";

        $svpic = "";
        if(isset($_FILES['pictfile']) && is_uploaded_file($_FILES['pictfile']['tmp_name'])){
            $image_name = $_FILES['pictfile']['name'];
            $image_size = $_FILES['pictfile']['size'];
            $image_temp = $_FILES['pictfile']['tmp_namae'];
            if($image_size > 512000){
                die("Ukuran file gambar terlalu besar, jangan lebih dari 5kb - (". $image_size .")");
            }
            $image_size_info = getimagesize($image_temp);
            if($image_size_info){
                $image_width = $image_size_info[0];
                $image_height = $image_size_info[1];
                $image_type = $image_size_info['mime'];
            }else{
                die("Pastikan file gambar yang diunggah ! !");
            }
            switch($image_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp);
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp);
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
                $kacak = random(5);
                $new_file_name = 'User-' . $kacak . '-' . $sesi . '.' . $image_extension;
                $image_save_folder = $destination_folder . $new_file_name;
                $image_save_folder2 = $destination_folder . $new_file_name2;
                
                if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_width, $max_image_height, $image_width, $image_height, $jpeg_quality)){
                    $savepic = "exist";
                }
                imagedestroy($image_res);
            }
        }
        if($savepic == 'exist'){
            $pic = $new_file_name;
        }
        $msql = "UPDATE `portdata` SET `foto` ='$pic' WHERE `sesi` = '$sesi'";
        $mquery = mysqli_query($koneksi,$msql);
        if($mquery){
            echo "ok";
        }
    }
}

?>