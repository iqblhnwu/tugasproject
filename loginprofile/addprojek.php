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
        
        $('#apalah').on('submit', function(e){
            let formData = new FormData($(this)[0]);
            formData.append('vcek','addpjk');
            $.ajax({
                url: "proses.php",
                type: "POST",
                data:formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(resp){
                    alert("Success!");
                    // if(resp.trim() == 'ok'){
                    //     alert('Success!');
                    //     $('#ppmodal').modal('hide');
                    //     window.location.reload();
                    // }else{
                    //     alert(resp);
                    // }
                }
            })
        })
    })
</script>
<form id="apalah" enctype="multipart/form-data">
    <div class="mb-3">
        <div class="form-group">
            <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
            <label>Judul projek :</label>
            <input type="text" name="ejudul" id="ijudul" class="form-control" required></input>
        </div>
        <div class="form-group">
            <label>Pilih Foto :</label>
            <div class="custom-file">
                <input type="file" name="fileFoto" id="csfile" class="custom-file-input"></input>
                <label class="custom-file-label" for="csfile">Choose file</label>
                <small class="form-text text-info">Jika belum ada foto, boleh dikosongkan.</small>
            </div> 
        </div>    
        <div class="form-group">
            <div class="mb-3">
                <label>Deskripsi :</label>
                <textarea id="editeks" name="eteks" class="form-control" required></textarea>
            </div>
        </div>     
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>