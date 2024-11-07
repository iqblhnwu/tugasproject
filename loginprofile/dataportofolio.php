<?php 
include '../config/config.php';
$sqlport = "SELECT * FROM portdata where sesi = 'Owner'";
$queryport = mysqli_query($koneksi, $sqlport);
if(mysqli_num_rows($queryport) == 0){
    echo 'none';
}else{
    $data = mysqli_fetch_assoc($queryport);
}
?>
<script>
    $(document).ready(function(){
        $('#ubahHero').on('click', function(e){
            e.preventDefault();
            $('#ppmodal').modal('show');
            $('#judulModal').html('Ubah Hero');
            $('#isimodal').load('edithero.php');
        })
        $('#ubahabout').on('click', function(e){
            e.preventDefault();
            $('#ppmodal').modal('show');
            $('#judulModal').html('Ubah About');
            $('#isimodal').load('editabout.php');
        })
        $('#addpjk').on('click',function(e){
            e.preventDefault();
            $('#ppmodal').modal('show');
            $('#judulModal').html('Tambah Data');
            $('#isimodal').load('addprojek.php');
        })
        $('.suntingpj').on('click',function(e){
            e.preventDefault();
            let idpj = $(this).attr('id');
            $('#ppmodal').modal('show');
            $('#judulModal').html('Edit Project');

            $.post('editprojek.php',{
                id: idpj
            }, function(resp){
                $('#isimodal').html(resp);
            })
        })
        $('.hapus').on('click', function(e){
            e.preventDefault();
            let idhp = $(this).attr('id');
            let cek = "delpj";
            $.ajax({
                url: "proses.php",
                type: "POST",
                dataType: "html",
                data:{
                    id: idhp,
                    vcek: cek
                },
                success: function(resp){
                    if(resp.trim() == 'ok'){
                        alert("Berhasil Dihapus !");
                        
                        $.post('dataportofolio.php',{
                        }, function(data){
                            $('#tampilPortofolio').html(data)
                        })
                    }else{
                        alert(resp);
                    }
                }
            })
        })
    })
</script>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel">
        <section class="hero text-center" style="padding-top:5rem;" >
            <?php 
            $pict = "nopict.png";
            if ($data['foto'] != ''){
                $pict = $data['foto'];
            }
            ?>
            <h1><i type="button" title="Edit Nama" id="ubahHero" class="fa-solid fa-pen-to-square"></i></h1>
            <img src="../asset/img/user/<?= $pict?>" alt="pict" class="rounded-circle img-thumbnail" width="250px" height="250px">
            <h1 class="display-4"><?php echo $data['namaleng'];?></h1>
            <p class="lead"><?php echo $data['txthero'];?></p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,218.7C384,213,480,235,576,218.7C672,203,768,149,864,133.3C960,117,1056,139,1152,122.7C1248,107,1344,53,1392,26.7L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </section>
        <section id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm text-center mb-3">
                        <h2>About Me <i type="button" id="ubahabout" title="Edit About" class="fa-solid fa-pen-to-square"></i></h2>
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
                        <h2>Project <i type="button" id="addpjk" title="Tambah Project" class="fa-solid fa-pen-to-square"></i></h2>
                    </div>
                </div> 
                <div class="row justify-content-center">
                    <?php 
                    $sqlproject = "SELECT * FROM projek";
                    $queryproject = mysqli_query($koneksi,$sqlproject);
                    if(mysqli_num_rows($queryproject) == 0){
                        ?>
                        <h2 class="text-center">Tidak Ada Data!</h2>
                        <?php
                    }else{
                        while($dp = mysqli_fetch_assoc($queryproject)){
                            ?>
                            <div class="col-md-3 mb-3">
                                <div class="card mb-3">
                                    <img src="../asset/img/projek/<?= $dp['gambar']?>" class="card-img-top" width="175px" height="175px" alt="...">
                                    <div class="card-body text-center">
                                        <input type="hidden" id="idpj" name="namaid" value="<?= $dp['id']?>">
                                        <h5 class="card-title mb-4"><?php echo $dp['title']?></h5>
                                        <p class="card-text "><?php echo $dp['txt']?></p>
                                        <button id="<?= $dp['id']?>" title="<?= $dp['id']?>" class="btn btn-danger hapus">Hapus</button>
                                        <button id="<?= $dp['id']?>" title="<?= $dp['id']?>" class="btn btn-info suntingpj">Edit</button>
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,138.7C384,128,480,128,576,133.3C672,139,768,149,864,176C960,203,1056,245,1152,250.7C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </section>
    </div>
</div>




<div class="modal fade" id="ppmodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white" id="judulModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="mb-3">
              <div id="isimodal"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
