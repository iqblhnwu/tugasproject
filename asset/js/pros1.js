function cekLogin() {
  let user = $("#loguser").val();
  let pass = $("#logpass").val();
  let check = 'login';

  if (user == "" && pass == "") {
    $("#loguser").focus();
  } else if (user == "") {
    $("#loguser").focus();
  } else if (pass == "") {
    $("#logpass").focus();
  } else {
    
    $.ajax({
      url: "config/proses.php",
      type: "POST",
      dataType: "html",
      data: {
        vcek: check,
        vuser: user,
        vpass: pass
        
      },
      success: function (valid) {
        alert("isi = "  + valid );
        if (valid == "ok") {
          window.location = "loginprofile/mainprofile.php";
          $("#loguser").val("");
          $("#logpass").val("");
        } else {
          alert(valid);
          $("#loguser").focus();
          $("#loguser").val("");
          $("#logpass").val("");
        }
      },
    });
  }
}

function showedit(){
  $('#editmodal').modal('show');
}

function showedit2(){
  $('#editmodal2').modal('show');
}

function showadd(){
  $('#addmodal').modal('show');
}
function editpictshow(){
  $('#ppmodal').modal('show');
}

function gantiFoto(){
  $('.custom-file-input').on('change', function(e) {
    var fileName = e.target.files[0].name;
    $('.custom-file-label').html(fileName);
  });

  let formData = new FormData($(this)[0]);
  let check = "addpict";
  $.ajax({
    url: "../config/proses.php",
    type: "POST",
    dataType: "html",
    data:{
      vcek: check,
      formData
    },
    contentType:false,
    cache:false,
    processData:false,
    success: function(resp){
      if(resp.trim() == 'ok'){
        alert(resp);
        window.location.reload();
      }else{
        alert('Error');
      }
    }
  })
}

function btnEdit(){
  let esesi = $("#idsesi").val();
  let enama = $("#editnama").val();
  let eteks = $("#editeks").val();
  let check = "edithero";
  
  $.ajax({
    url: "../config/proses.php",
    type: "POST",
    dataType: "html",
    data:{
      vcek: check,
      vsesi: esesi,
      vnama: enama,
      vteks: eteks
    },
    success: function(editan){
      if(editan.trim() == 'Success!'){
        alert(editan);
        $('#editmodal').modal('hide');
        window.location.reload();
      }else{
        alert(editan);
      }
    }
  })
}
function btnEdit2(){
  let esesi = $('#idsesi').val();
  let etxt1 = $('#editxt1').val();
  let etxt2 = $('#editxt2').val();
  let check = "editxtabout";
  $.ajax({
    url: "../config/proses.php",
    type: "POST",
    dataType: "html",
    data:{
      vcek: check,
      vsesi: esesi,
      vtxt1: etxt1,
      vtxt2: etxt2
    },
    success: function(editantxt){
      if(editantxt == "Success!"){
        alert(editantxt);
        $('#editmodal2').modal('hide');
        window.location.reload();
      }else{
        alert(editantxt);
      }
    }
  })
}