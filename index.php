<?php

include "koneksi.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tamplate Bootstrap</title>
    <link rel="stylesheet" type="text/css" href="asset/vendor/bootstrap/css/bootstrap.css">
    <!-- Template Main CSS File -->
    <link href="asset/css/style3.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="asset/css/styless_carousel.css"> -->
    <!-- Carousel Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid ms-5 me-5">
            <h1 class="logo me-auto me-lg-0"><a href="">RUNGO</a></h1>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav-col" aria-controls="trainit"
                aria-expanded="false" aria-lable="toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-lg-end" id="nav-col">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item"><a class="nav-link" href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Library</a></li>
                    <li class="nav-item"><a class="nav-link" href="">All Song</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Search</a></li>
                    <li class="nav-item">
                        <a class=" book-a-table-btn scrollto d-flex w-auto" href="login.php">Login
                        </a>
                    </li> -->
                </ul>
            </div>
            <a href="login.php" class=" book-a-table-btn scrollto d-none d-lg-flex">LOGIN</a>
        </div>
    </nav>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container-fluid mt-0 ">
            <div class="row">
                <div class="col-12 col-md-7 col-sm-12">
                    <div class="col">
                        <h1>FOR YOUR</h1>
                        <h1><span>MUSIC</span></h1>
                        <h2>A streaming service for all music fans!</h2>
                        <div class="btns">
                            <a href="login.php" class="btn-menu animated fadeInUp scrollto">
                                GET STARTED
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-5 col-sm-12 position-relative" data-aos="zoom-in" data-aos-delay="200"">
                <div class=" row">
                    <div class=" card">
                        <img src="asset/img/music1.jpg" alt="" class="foto1">
                        <h4>Music my Country</h4>
                        <div class="bar">
                            <div class="emptybar"></div>
                            <div class="filledbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>




    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.js"></script>

</body>

</html>