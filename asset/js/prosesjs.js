// function showedit(){
//   $('#editmodal').modal('show');
// }

// function showedit2(){
//   $('#editmodal2').modal('show');
// }

// function showadd(){
//   $('#addmodal').modal('show');
// }

// function btnEdit(){
//   let esesi = $("#idsesi").val();
//   let enama = $("#editnama").val();
//   let eteks = $("#editeks").val();
//   let check = "edithero";
  
//   $.ajax({
//     url: "../loginprofile/proses.php",
//     type: "POST",
//     dataType: "html",
//     data:{
//       vcek: check,
//       vsesi: esesi,
//       vnama: enama,
//       vteks: eteks
//     },
//     success: function(editan){
//       if(editan.trim() == 'Success!'){
//         alert(editan);
//         $('#editmodal').modal('hide');
//         window.location.reload();
//       }else{
//         alert(editan);
//       }
//     }
//   })
// }
// function btnEdit2(){
//   let esesi = $('#idsesi').val();
//   let etxt1 = $('#editxt1').val();
//   let etxt2 = $('#editxt2').val();
//   let check = "editxtabout";
//   $.ajax({
//     url: "../loginprofile/proses.php",
//     type: "POST",
//     dataType: "html",
//     data:{
//       vcek: check,
//       vsesi: esesi,
//       vtxt1: etxt1,
//       vtxt2: etxt2
//     },
//     success: function(editantxt){
//       if(editantxt == "Success!"){
//         alert(editantxt);
//         $('#editmodal2').modal('hide');
//         window.location.reload();
//       }else{
//         alert(editantxt);
//       }
//     }
//   })
// }

