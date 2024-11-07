<?php 
session_start();

include '../config/config.php';

?>

<script>
    $(document).ready(function(){
        $.post('../koleksi/datakoleksi.php',{
        }, function(respon){
            $('#TdataK').html(respon);
        })
    })
</script>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md text-center">
                <h2>My Collection</h2>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-4 mt-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Cari data</span>
                </div>
                <input type="text" class="form-control" placeholder="Type" id="inputCariDosen">
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div id="TdataK"></div>
</div>




