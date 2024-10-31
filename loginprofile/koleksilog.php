<?php 
session_start();

include '../config/config.php';
$sqlport = "SELECT * FROM portdata where sesi = 'Owner'";
$queryport = mysqli_query($koneksi, $sqlport);
if(mysqli_num_rows($queryport) == 0){
    echo 'none';
}else{
    $data = mysqli_fetch_assoc($queryport);
}
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md text-center">
                <h2>Koleksi</h2>
            </div>
        </div>
    </div>
</section>

