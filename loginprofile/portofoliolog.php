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


<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel">
        <section class="hero text-center" style="padding-top:5rem;" >
            <img src="../asset/img/user/foto1.jpg" type="button" onclick="showedit()" alt="pict" class="rounded-circle img-thumbnail" href="#">
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
                        <h2>About Me <i href="#" type="button" onclick="showedit2()" class="fa-solid fa-pen-to-square"></i></h2>
                        
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
                        <h2>Project <i href="#" type="button" onClick="showadd()" class="fa-solid fa-pen-to-square"></i></h2>
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
    </div>
</div>


<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="mb-3">
                <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
                <label>Edit nama :</label>
                <input type="text" id="editnama" name="enama" class="form-control" value="<?php echo $data['namaleng']?>"></input>
            </div>
            <div class="mb-3">
                <label>Edit teks :</label>
                <textarea id="editeks" name="eteks" class="form-control"><?php echo $data['txthero']?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnedit" onClick="btnEdit()" >Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editmodal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="mb-3">
                <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
                <label>Edit teks kiri :</label>
                <textarea id="editxt1" name="etxt1" class="form-control"><?php echo $data['txtabout1']?></textarea>
            </div>
            <div class="mb-3">
                <label>Edit teks kanan:</label>
                <textarea id="editxt2" name="etxt2" class="form-control"><?php echo $data['txtabout2']?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnedit2" onClick="btnEdit2()" >Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="mb-3">
                <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
                <label>Pilih Foto :</label>
                <div class="custom-file">
                  
                  <input type="file" id="csfile" class="custom-file-input"></input>
                  <label class="custom-file-label" for="csfile">Choose file</label>
                </div>
                
            </div>
            <div class="mb-3">
                <label>Edit teks :</label>
                <textarea id="editeks" name="eteks" class="form-control"><?php echo $data['txthero']?></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnadd" onClick="btnAdd()" >Simpan</button>
      </div>
    </div>
  </div>
</div>
