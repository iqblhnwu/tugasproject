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
}

?>