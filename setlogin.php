<?php
session_start();

include 'config/config.php';

$user = addslashes($_POST['vuser']);
$pass = addslashes($_POST['vpass']);
    
$sql = "SELECT * FROM login WHERE username = '$user' AND pw = '" . MD5($pass) . "'";
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
