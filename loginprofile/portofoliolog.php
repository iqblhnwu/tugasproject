<?php
session_start();

include '../config/config.php';


?>

<script>
  $(document).ready(function(){
    $.post('dataportofolio.php',{
    }, function(respon){
      $('#tampilPortofolio').html(respon);
    })
  })
</script>

<div id="tampilPortofolio"></div>