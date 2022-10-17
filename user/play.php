<?php
include "../koneksi.php";

$id_lagu = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM lagu WHERE id_lagu='$id_lagu' ");
$detaillagu = $ambil->fetch_assoc();


$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

//siapkan hasil lagu untuk perhitungan
$hasillagu = array();

//dapatkan dari lagu yang di play user
$valensi_user = $detaillagu['valensi'];
$energi_user = $detaillagu['energi'];
$distance = array();

//perulangkan lagu
foreach ($semualagu as $key => $perlagu) {
    $id_lagu = $perlagu['id_lagu'];
    $valensi_lagu = $perlagu['valensi'];
    $energi_lagu = $perlagu['energi'];

    // if ($valensi_lagu < 1) {
    //     $valensi_user = $valensi_user / 100;
    // }
    // if ($energi_lagu < 1) {
    //     $energi_user = $energi_user / 100;
    // }

    $jarak = sqrt(pow($valensi_user - $valensi_lagu, 2) + pow($energi_user - $energi_lagu, 2));
    $distance[$id_lagu] = $jarak;
}

//urutkan dari jarak terkecil
asort($distance);

//potong 10 lagu yang di rekomendasikan
$nomor = 1;
foreach ($distance as $id_lagu => $jarak) {
    if ($nomor <= 5) {
        $ambil = $koneksi->query("SELECT * FROM lagu WHERE id_lagu='$id_lagu' ");
        $lagu = $ambil->fetch_assoc();
        $lagu['jarak'] = $jarak;
        $hasillagu[] = $lagu;
        $nomor++;
    }
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
    <style>
    section {
        height: 586px;
        background-color: #04212c;
    }

    .row2 {
        padding: 10px;
        color: aliceblue;
        padding-bottom: 15px;
    }

    .row2:hover {
        opacity: 90%;
        background-color: #04216c;
        padding-bottom: 20px;
    }

    .row2 a {
        color: aliceblue;
        text-decoration: none;

    }

    .row2 a:hover {
        color: aqua;
    }
    </style>
</head>

<body>
    <?php
    include "menu.php"; ?>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="text-white mb-3"><?php echo $detaillagu["artis"] ?> - <?php echo $detaillagu["title"] ?>
                    </h3>
                    <div class="col-12">
                        <div class="ratio ratio-16x9 text-center mt-4 mb-4 ">
                            <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/<?php echo $detaillagu["link_youtube"] ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>

                </div>

                <div class="col-md-5 ps-5">
                    <div class="row bg-black">
                        <div class="col-6 pb-2">
                            <nav id="navbar-example3" class=" align-items-stretch pe-4 ">
                                <nav class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white mt-2 " href="">BERIKUTNYA</a>
                                    </li>
                                </nav>
                            </nav>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 ">
                            <?php foreach ($hasillagu as $key => $perlagu) : ?>
                            <div class="row2 border-bottom" id="scrollspyHeading1">
                                <h6 class="forYou" id="idnya">
                                    <a href="play.php?id=<?php echo $perlagu['id_lagu'] ?>">
                                        <?php echo $perlagu['title'] ?>
                                        <br>
                                    </a>
                                </h6>
                                <span class="small "><?php echo $perlagu['artis'] ?></span>
                                <i class="bi bi-music-note-list text-primary"
                                    idnya="<?php echo $perlagu["id_lagu"] ?>"></i>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".bi").on("click", function() {
            var id_lagu = $(this).attr("idnya");

            $.ajax({
                url: 'simpanplaylist.php',
                type: 'post',
                data: 'id_lagu=' + id_lagu,
                success: function(hasil) {
                    $.ajax({
                        url: 'tampilplaylist.php',
                        type: 'post',
                        success: function(isi_playlist) {
                            $(".letak-playlist").html(isi_playlist);
                        }
                    })
                }
            })
        })
    })
    </script>


</body>

</html>