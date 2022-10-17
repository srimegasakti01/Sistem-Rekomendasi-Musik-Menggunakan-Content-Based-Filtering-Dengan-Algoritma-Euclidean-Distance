<?php
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda harus login')</script>";
    echo "<script>location = '../login.php' </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUNGO</title>
    <link rel="stylesheet" type="text/css" href="../asset/vendor/bootstrap/css/bootstrap.css">

</head>

<body">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
        <div class="container">
            <a href="" class="navbar-brand">LTYH</a>
            <ul class="navbar-nav me-5">
                <li class="nav-item">
                    <a href="" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Explore</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Library</a>
                </li>
                <li class="nav-item">
                    <i class="fa fa-bars"></i>
                    <a href="" class="nav-link">Search</a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="py-5" style="background:black;">
        <div class="container">
            <h5 class="text-white">Chart</h5>
            <div class="row">
                <div class="col-md-2">
                    <div class="card bg-black">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body text-white">
                            <h6 class="small">It Must Have Been Love</h6>
                            <span class="text-muted small">Roxette</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h6 class="small">Just Call Angel of Morning</h6>
                            <span class="text-muted small">Juicy Newton</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h6 class="small">Helena</h6>
                            <span class="text-muted small">My Chemical Romance</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h6 class="small">Helena</h6>
                            <span class="text-muted small">My Chemical Romance</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h6 class="small">Helena</h6>
                            <span class="text-muted small">My Chemical Romance</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h6 class="small">Helena</h6>
                            <span class="text-muted small">My Chemical Romance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </body>

</html>