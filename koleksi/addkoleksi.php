<?php 
include '../config/config.php';

?>

<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function(e) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
        $('#tambahData').on('submit', function(e){
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            formData.append('vcek','addkoleksi');
            $.ajax({
                url: "proses.php",
                type: "POST",
                data:formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(resp){
                    $('#Kmodal').modal('hide');
                    if(resp.trim() == 'ok'){
                        alert('Success !');
                        $.post('../koleksi/datakoleksi.php',{
                        },function(data){
                            $('#TdataK').html(data);
                        })
                    }else{
                        alert(resp);
                        $.post('../koleksi/datakoleksi.php',{
                        }, function(x){
                            $('#TdataK').html(data);
                        })
                    }
                }
            })
        })
    })
</script>

<form enctype="multipart/form-data" id="tambahData">
    <div class="mb-3">
        <div class="form-group">
            <input type="hidden" id="idsesi" name="esesi" value="Owner">
            <label>Nama :</label>
            <input type="text" name="ejudul" id="ijudul" class="form-control" required></input>
        </div>
        <div class="form-group">
            <label>Pilih Foto:</label>
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
    <button type="submit" class="btn btn-primary" >Simpan</button>
</form>