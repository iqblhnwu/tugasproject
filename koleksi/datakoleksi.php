<?php 
include '../config/config.php';
?>

<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function(e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });

        $('#tambahDataK').on('click', function(){
            $('#Kmodal').modal('show');
            $('#judulModal').html('Tambah Data');
            $('#isimodal').load('../koleksi/addkoleksi.php');
        })
        $('.edit').on('click', function(e){
            e.preventDefault();
            let idpj = $(this).attr('id');
            $('#Kmodal').modal('show');
            $('#judulModal').html('Edit Data');

            $.post('../koleksi/editkoleksi.php',{
                id: idpj
            }, function(resp){
                $('#isimodal').html(resp);
            })
        })
        $('.hapus').on('click', function(e){
            e.preventDefault();
            let idhp = $(this).attr('id');
            let cek = "deleteK";
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
                        
                        $.post('../koleksi/datakoleksi.php',{
                        }, function(data){
                            $('#TdataK').html(data)
                        })
                    }else{
                        alert(resp);
                    }
                }
            })
        })
    })
</script>


<div class="container">
    <div class="row justify-content-center">
        <button class="btn btn-success" id="tambahDataK">+Add data</button>
    </div>
</div>


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
                                        <img src="../asset/img/koleksi/<?= $datak['foto']?>" class="rounded" width="150px" height="140px" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <button type="button" class="close float-right mr-2 hapus" title="Hapus" id="<?= $datak['id']?>"><i class="far fa-trash-alt"></i></button>
                                        <button type="button" class="close float-right mr-2 edit" title="Ubah" id="<?= $datak['id']?>"><i class="far fa-edit"></i></button>
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

<div class="modal fade" id="Kmodal" tabindex="-1">
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
