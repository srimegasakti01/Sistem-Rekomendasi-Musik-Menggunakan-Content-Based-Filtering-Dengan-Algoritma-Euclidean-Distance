<?php
include "../koneksi.php";

$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../asset/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
</head>

<body>


    <?php
    include "menu.php"; ?>

    <div class="container-fluid bg-black p-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <input type="text" name="cari" class="form-control input-lg" placeholder="Cari Lagu, artis, genre">
            </div>
        </div>

        <h4 class="text-white">Explore</h4>
        <div class="row">
            <?php foreach ($semualagu as $key => $value) : ?>
            <div class="col-md-2">
                <div class="div">
                    <div class="card bg-black">
                        <img src="../asset/img/music1.jpg" alt="" class="card-img-top">
                        <div class="card-body text-white">
                            <h6 class="small"><?php echo $value['title'] ?></h6>
                            <span class="text-muted small"><?php echo $value['artis'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>






            <!-- <div class="col-md-4">
                <h3 class="text-white ps-3 pt-1">Recent activity</h3>
                <div class="m-3">
                    <div class="letak-playlist"></div>
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>