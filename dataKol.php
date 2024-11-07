<?php 
include 'config/config.php';
?>
    <div class="mt-4 mb-4">
        <div class="container">
            <div class="row">
                <?php 
                $sqlk = "SELECT * FROM `koleksi`";
                $queryk = mysqli_query($koneksi,$sqlk);
                if(mysqli_num_rows($queryk) == 0){
                    ?>
                    <div class="col-md text-center">
                        <h3>Tidak Ada Data !</h3>
                    </div>
                    <?php
                }else{
                    while($datak = mysqli_fetch_assoc($queryk)){
                        ?>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light" style="height:180px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" id="idK" name="namaK" value="<?= $datak['id']?>">
                                            <img src="asset/img/koleksi/<?= $datak['foto']?>" class="rounded" width="180px" height="140px" alt="">
                                        </div>
                                        <div class="col-md-8 pl-5">
                                            <div class="card-title">
                                                <h6><?= $datak['nama']?></h6>
                                            </div>
                                            <div>
                                                <p><?= $datak['deskrip']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                
            </div>
        </div>
    </div>