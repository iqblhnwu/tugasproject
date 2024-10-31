<?php 
session_start();

if(!isset($_SESSION['lvl'])){
    header('location: ../index.php');
}else{
    include '../config/config.php';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../asset/js/jquery-3.7.1.min.js"></script>
    <script src="../asset/js/bootstrap.bundle.js"></script>
    <script src="../asset/js/prosesjs.js"></script>

    <script>
        $(document).ready(function(){
            
            $('#isi2').load('portofoliolog.php');
            
            $('.navi').on('click', function(e){
                e.preventDefault();
                var log = $(this).attr('id');
                if(log == "btnhome"){
                    $('#isi2').load('portofoliolog.php');
                }else if(log == "btnkoleksi"){
                    $('#isi2').load('koleksilog.php');
                }
                    
            })

            $('#btnlogout').on('click', function(e){
                e.preventDefault();
                window.location.href = '../index.php';
            })
        })

    </script>
    <title>Portofolio</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top" style="background-color: #ffcd43;">
            <div class="container">
                <a class="navbar-brand login"><?= $_SESSION['lvl']?> <i class="fa-solid fa-mug-hot"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link navi" id="btnhome" href="#home" >Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navi" id="btnkoleksi" href="#koleksi">Koleksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="btnlogout" href="#logout">Logout</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>
    <div id="isi2"></div>

    <footer style="background-color:#fde8ae;" class="text-center pb-3">
        <p>Created By <a href="#" class="text-dark">IqbalHunowu</a></p>
    </footer>
</body>
</html>