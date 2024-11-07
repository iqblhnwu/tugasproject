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
        $('.custom-file-input').on('change', function(e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        $('.del').on('click', function(e){
            e.preventDefault();
            let cek = "delpict";
            $.ajax({
                url: "proses.php",
                type: "POST",
                dataType: "html",
                data:{
                    vcek: cek
                },
                success: function(resp){
                    $('#ppmodal').modal('hide');
                    if(resp.trim() == 'ok'){
                        alert("Berhasil Dihapus !");
                        $.post('dataportofolio.php',{
                        }, function(x){
                            $('#tampilPortofolio').html(x)
                        })
                    }else{
                        alert(resp);
                        $.post('dataportofolio.php',{
                        }, function(x){
                            $('#tampilPortofolio').html(x)
                        })
                    }
                }
            })

        })
        $('#gantiH').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData ($(this)[0]);
            formData.append('vcek','edithero');
            // alert(formData)
            $.ajax({
                url: "proses.php",
                type: "POST",
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(x){
                    $('#ppmodal').modal('hide');
                    if(x.trim() == 'ok'){
                        alert("Success!");
                        $.post('dataportofolio.php',{
                        }, function(x){
                            $('#tampilPortofolio').html(x)
                        })
                    }else if(x.trim() == 'okok'){
                        alert("Success!");
                        $.post('dataportofolio.php',{
                        }, function(x){
                            $('#tampilPortofolio').html(x)
                        })
                    }else{
                        alert(x);
                        $.post('dataportofolio.php',{
                        }, function(x){
                            $('#tampilPortofolio').html(x)
                        })
                    }
                }
            });
        })
    })
</script>
<form id="gantiH" enctype="multipart/form-data">
    <div class="mb-3">
        <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
        <div class="form-group">
            <label>Pilih Foto :</label>
            <div class="custom-file">
                <input type="file" name="fileFoto" id="csfile" class="custom-file-input"></input>
                <label class="custom-file-label" for="csfile">Choose file</label>
                <small class="form-text text-info">Jika belum ada foto, boleh dikosongkan.</small>
            </div> 
        </div>   
        <label>Edit nama :</label>
        <input type="text" id="editnama" name="enama" class="form-control" value="<?php echo $data['namaleng']?>"></input>
    </div>
    <div class="mb-3">
        <label>Edit teks :</label>
        <textarea id="editeks" name="eteks" class="form-control"><?php echo $data['txthero']?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" id="delpict" class="btn btn-danger del" >hapus foto</button>
</form>
