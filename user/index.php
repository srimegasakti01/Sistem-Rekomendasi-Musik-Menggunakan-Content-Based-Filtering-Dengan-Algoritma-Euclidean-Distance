<?php
include "../koneksi.php";

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda harus login')</script>";
    echo "<script>location = '../login.php' </script>";
}

$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

$hasillagu = array();
if (isset($_GET['valensi']) and isset($_GET['energi'])) {

    //siapkan hasil lagu untuk perhitungan
    $hasillagu = array();

    //dapatkan inputan user dari klik icon
    $valensi_user = $_GET['valensi'];
    $energi_user = $_GET['energi'];
    $distance = array();

    //perulangkan lagu
    foreach ($semualagu as $key => $perlagu) {
        $id_lagu = $perlagu['id_lagu'];
        $valensi_lagu = $perlagu['valensi'];
        $energi_lagu = $perlagu['energi'];
        $jarak = sqrt(pow($valensi_lagu - $valensi_user, 2) + pow($energi_lagu - $energi_user, 2));
        $distance[$id_lagu] = $jarak;
    }

    //urutkan dari jarak terkecil
    asort($distance);

    //potong 10 lagu yang di rekomendasikan
    $nomor = 1;
    foreach ($distance as $id_lagu => $jarak) {
        if ($nomor <= 10) {
            $ambil = $koneksi->query("SELECT * FROM lagu WHERE id_lagu='$id_lagu' ");
            $lagu = $ambil->fetch_assoc();
            $lagu['jarak'] = $jarak;
            $hasillagu[] = $lagu;
            $nomor++;
        }
    }
}




$SemuaArtis = array();
$ambil = $koneksi->query("SELECT * FROM penyanyi");
while ($tiap = $ambil->fetch_assoc()) {
    $SemuaArtis[] = $tiap;
}

$Semuamood = array();
$ambil = $koneksi->query("SELECT * FROM mood");
while ($tiap = $ambil->fetch_assoc()) {
    $Semuamood[] = $tiap;
}

//lagu trending 1 pekan terakhir
$hariini = date("Y-m-d");
$yanglalu = (new DateTime($hariini))->modify("-7 days")->format('Y-m-d');

$trending = array();
$ambil  = $koneksi->query("SELECT *,COUNT(*) as mainkan FROM main
LEFT JOIN lagu on main.id_lagu=lagu.id_lagu
WHERE tanggal BETWEEN '$yanglalu' AND '$hariini' 
GROUP BY main.id_lagu ORDER BY mainkan DESC LIMIT 10 ");

while ($tiap = $ambil->fetch_assoc()) {
    $trending[] = $tiap;
}


$favorit = array();
$id_user = $_SESSION['user']['id_user'];

$ambil = $koneksi->query("SELECT * FROM favorit LEFT JOIN penyanyi ON favorit.id_penyanyi=penyanyi.id_penyanyi WHERE id_user='$id_user' ");
while ($tiap = $ambil->fetch_assoc()) {
    $favorit[] = $tiap;
}

// echo "<pre>";
// print_r($favorit);
// echo "</pre>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../asset/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/vendor/jquery/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">

    <style>
    section {
        background-color: #04212c;
    }

    .art {
        color: aliceblue;
    }

    .recom {
        color: aliceblue;
    }

    .recom:hover {
        opacity: 90%;
        background-color: #1d566b;
        padding-bottom: 10px;
    }

    .recom a {
        color: aliceblue;
        text-decoration: none;
    }

    h2 {
        color: aqua;
    }

    .recom a:hover {
        color: aqua;
    }
    </style>

</head>


<body>
    <?php
    include "menu.php"; ?>

    <section class="py-5">
        <div class="container">
            <h3 class="mb-3 text-light">Mood hari ini </h3>
            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="0.90" energi="0.15"
                id="Happy">Happy</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="0.90" energi="0.35"
                id="Delighted">Delighted</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary me-4" valensi="0.70" energi="0.72"
                id="Excited">Excited</button>

            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="0.02" energi="-1"
                id="Sleepy">Sleepy</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="0.90" energi="-0.65"
                id="Calm">Calm</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary me-4" valensi="0.90" energi="-0.55"
                id="Content">Content</button>

            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="-0.02" energi="0.85"
                id="Tense">Tense</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="-0.40" energi="0.8"
                id="Angry">Angry</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary me-4" valensi="-0.70" energi="0.55"
                id="Distressed">Distressed</button>

            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="-0.80" energi="-0.40"
                id="Sad">Sad</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary" valensi="-0.82" energi="-0.45"
                id="Despressed">Despressed</button>
            <button type="button" class="pilih-mood btn btn-outline-secondary me-4" valensi="-0.35" energi="-0.80"
                id="Bored">Bored</button>




            <div class="row">
                <div class="col-md-12 pt-5 letak-hasil">
                    <div id="wait" class="spinner-border text-primary" role="status" style="display:none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="row ">
                        <h2 class="mb-4">Special For You</h2>
                        <?php foreach ($hasillagu as $key => $perlagu) : ?>
                        <div class="recom col-md-6">
                            <h5>
                                <a href="play.php?id=<?php echo $perlagu['id_lagu'] ?>">
                                    <?php echo $perlagu['title'] ?>
                                </a>
                            </h5>
                            <span class="art small"><?php echo $perlagu['artis'] ?></span>
                            <hr>
                        </div>
                        <?php endforeach ?>

                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="py-5" style="background:black;">
        <div class="container">
            <h3 class="text-white">Artis Favoritmu</h3>
            <hr>
            <div class="row">
                <?php foreach ($favorit as $key => $value) :  ?>
                <div class="col-md-2">
                    <div class="card bg-black mb-4 ">
                        <a href="" class="" style="text-decoration: none;">
                            <img src="../asset/img/artis/<?php echo $value["foto_artis"]; ?>"
                                class="img-thumbnail rounded-circle p-2">
                            <div class="card-body text-white">
                                <h6 class="small text-center"><?php echo $value["artis"] ?></h6>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach ?>


                <?php foreach ($trending as $key => $value) :  ?>
                <div class="col-md-2">
                    <div class="card bg-black">
                        <img src="../asset/img/artis/<?php echo $value["foto_artis"]; ?>"
                            class="img-thumbnail rounded-circle p-2">
                        <div class="card-body text-white">
                            <h6 class="small"><?php echo $value['title'] ?></h6>
                            <span class="text-muted small"><?php echo $value['artis'] ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    //apabila ada emoji di klik, maka dapatkan nilai valensi dan energinya, lalu suruh carilagu.php untuk mendapatkan hasil sesuai valensi dan energi.
    $(document).ready(function() {
        $(".pilih-mood").on("click", function() {
            var valensi = $(this).attr("valensi");
            var energi = $(this).attr("energi");
            var mood = $(this).attr("id");

            $.ajax({
                type: 'post',
                url: 'carilagu.php',
                data: 'valensi=' + valensi + '&energi=' + energi + '&mood=' + mood,
                beforeSend: function() {
                    $('#wait').show();
                },
                complete: function() {
                    $('#wait').hide();
                },
                success: function(hasil) {
                    $(".letak-hasil").html(hasil);
                }
            })
        })
    })
    </script>


</body>

</html>