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
        $('#gantiA').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData ($(this)[0]);
            formData.append('vcek','eabout');
            $.ajax({
                url: "proses.php",
                type: "POST",
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(x){
                    if(x.trim() == 'ok'){
                        alert("Success!");
                        $('#ppmodal').modal('hide');
                        window.location.reload();
                    }
                }
            });
        })
    })
</script>
<form id="gantiA" enctype="multipart/form-data">
    <div class="mb-3">
        <input type="hidden" id="idsesi" name="esesi" value="<?php echo $data['sesi']?>">
        <label>Edit teks kiri :</label>
        <textarea id="editxt1" name="etxt1" class="form-control"><?php echo $data['txtabout1']?></textarea>
    </div>
    <div class="mb-3">
        <label>Edit teks kanan:</label>
        <textarea id="editxt2" name="etxt2" class="form-control"><?php echo $data['txtabout2']?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>