<?php 
session_start();
session_unset();
session_destroy();

include "config/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="asset/js/jquery-3.7.1.min.js"></script>
    <script src="asset/js/bootstrap.bundle.js"></script>
    <script src="asset/js/pros.js"></script>

    <script>
        $(document).ready(function(){
            $('.content').load('portofolio.php');
            
            $('.login').on('click', function(e){
                e.preventDefault();
                var log = $(this).attr('id');
                if(log == "btnhome"){
                    $('.content').load('portofolio.php');
                }else if(log == "btnlogin"){
                    $('.content').load('login.php');
                }else if(log == "btnkoleksi"){
                    $('.content').load('koleksi.php');
                }
            })
        })

    </script>
    <title>Portofolio</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top" style="background-color: #ffcd43;">
            <div class="container">
                <a class="navbar-brand login" id="btnlogin" type="button">Iqbalzz <i class="fa-solid fa-mug-hot"></i></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link login" id="btnhome" href="#home" >Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link login" id="btnkoleksi" href="#koleksi">Koleksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content"></div>

    <footer style="background-color:#fde8ae;" class="text-center pb-3">
        <p>Created By <a href="#" class="text-dark">IqbalHunowu</a></p>
    </footer>
</body>
</html>