<?php

include 'config/config.php';

$sqlport = "SELECT * FROM portdata where sesi = 'Owner'";
$queryport = mysqli_query($koneksi, $sqlport);
if(mysqli_num_rows($queryport) == 0){
    echo 'none';
}else{
    $data = mysqli_fetch_assoc($queryport);
}
?>


<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel">
        <section class="hero text-center" style="padding-top:5rem;" >
            <?php 
            $pict = "nopict.png";
            if ($data['foto'] != ''){
                $pict = $data['foto'];
            }
            ?>
            <img src="asset/img/user/<?= $pict?>" alt="..." class="rounded-circle img-thumbnail" width="250px" height="250px">
            <h1 class="display-4"><?php echo $data['namaleng']?></h1>
            <p class="lead"><?php echo $data['txthero'];?></p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,218.7C384,213,480,235,576,218.7C672,203,768,149,864,133.3C960,117,1056,139,1152,122.7C1248,107,1344,53,1392,26.7L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </section>

        <section id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm text-center mb-3">
                        <h2>About Me</h2>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-4">
                        <?php echo $data['txtabout1']?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $data['txtabout2']?>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fde8ae" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,218.7C384,213,480,235,576,218.7C672,203,768,149,864,133.3C960,117,1056,139,1152,122.7C1248,107,1344,53,1392,26.7L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </section>

        <section id="project">
            <div class="container">
                <div class="row">
                    <div class="col-sm text-center mb-3">
                        <h2>Project</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-3">
                        <?php 
                            $sqlproject = "SELECT * FROM projek";
                            $queryproject = mysqli_query($koneksi,$sqlproject);
                            if(mysqli_num_rows($queryproject) == 0){
                                ?>
                                <h2 class="text-center">Tidak Ada Data!</h2>
                                <?php
                            }else{
                                ?>
                                <div class="card">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-title"><?php echo $queryproject['title']?></p>
                                        <p class="card-text"><?php echo $queryproject['txt']?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,138.7C384,128,480,128,576,133.3C672,139,768,149,864,176C960,203,1056,245,1152,250.7C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm text-center mb-3">
                        <h2>Contact Me</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Nama Lengkap : </label>
                            <input type="text" class="form-control" name="vname" id="cname" aria-describedby="name">
                        </div>    
                        <div class="mb-3">
                            <label for="email">Email : </label>
                            <input type="email" class="form-control" name="vemail" id="cemail" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="pesan">Pesan : </label>
                            <textarea class="form-control" name="vpesan" id="cpesan" rows="3"></textarea>
                        </div>
                            
                            <button type="submit"  class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fde8ae" fill-opacity="1" d="M0,128L48,138.7C96,149,192,171,288,197.3C384,224,480,256,576,277.3C672,299,768,309,864,261.3C960,213,1056,107,1152,74.7C1248,43,1344,85,1392,106.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </section>
    </div>
</div>