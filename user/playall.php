<?php
include "../koneksi.php";

$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

//siapkan hasil lagu untuk perhitungan
$hasillagu = array();

//dapatkan inputan user dari klik icon
$mood_user = $_SESSION['mood'];
$ambil = $koneksi->query("SELECT * FROM mood WHERE nama_mood='$mood_user' ");
$mood = $ambil->fetch_assoc();
$valensi_user = $mood['valensi'];
$energi_user = $mood['energi'];

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

if (!isset($_GET['id'])) {
    $putar['id'] = $hasillagu[0]['id_lagu'];
    $putar['title'] = $hasillagu[0]['title'];
    $putar['artis'] = $hasillagu[0]['artis'];
    $putar['link_youtube'] = $hasillagu[0]['link_youtube'];
} else {
    $id_lagu = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM lagu WHERE id_lagu='$id_lagu' ");
    $detaillagu = $ambil->fetch_assoc();
    $putar['id'] = $detaillagu['id_lagu'];
    $putar['title'] = $detaillagu['title'];
    $putar['artis'] = $detaillagu['artis'];
    $putar['link_youtube'] = $detaillagu['link_youtube'];
}

$id_user = $_SESSION['user']['id_user'];
$idl = $putar['id'];
$jupuk = $koneksi->query("SELECT * FROM survey WHERE id_lagu='$idl' AND $id_user='$id_user' AND mood='$mood_user' ");
$ceksurvey = $jupuk->fetch_assoc();

// echo "<pre>";
// print_r($_SESSION['mood']);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">

    <style>
    section {
        height: 700px;
        background-color: #04212c;
    }

    h3 {
        color: aqua;
    }

    h6 {
        color: aliceblue;
    }

    .textA {
        color: aqua;
    }

    .rowA:hover {
        opacity: 90%;
        background-color: #04216c;
        padding-bottom: 10px;
    }

    .emoji:hover {
        background-color: teal;
    }
    </style>
</head>

<body>
    <?php
    include "menu.php"; ?>
    <section class=" py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-12">
                        <div class="ratio ratio-16x9 text-center mt-4 mb-4 ">
                            <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/<?php echo $putar["link_youtube"] ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <h3><?php echo $putar['title'] ?></h3>
                    <span class="text-white"><?php echo $putar['artis'] ?></span>
                    <hr>
                    <?php if (empty($ceksurvey)) : ?>
                    <form method="post">
                        <h6 class="mb-4">Apakah lagu ini sesuai dengan mood anda? (<?php echo $_SESSION['mood'] ?>)</h6>
                        <div class="row">
                            <div class="emoji col-md-2 text-center">
                                <a href="survey.php?lagu=<?php echo $putar['id'] ?>&nilai=0"
                                    class="text-decoration-none">
                                    <img src="../asset/img/mood/very dislike.png" alt="sangat buruk"
                                        class="bg-black img-thumbnail rounded-circle p-2 justify-content-center"
                                        style="width: 65px; height: 55px;">
                                    <br>
                                    <span class="text-white small">Sangat Buruk</span>
                                </a>
                            </div>
                            <div class="emoji col-md-2 text-center">
                                <a href="survey.php?lagu=<?php echo $putar['id'] ?>&nilai=1"
                                    class="text-decoration-none">
                                    <img src="../asset/img/mood/dislike.png" alt="buruk" width="55px"
                                        class="bg-black img-thumbnail rounded-circle p-2">
                                    <br>
                                    <span class="text-white small">Buruk</span> </a>
                            </div>
                            <div class="emoji col-md-2 text-center">
                                <a href="survey.php?lagu=<?php echo $putar['id'] ?>&nilai=2"
                                    class="text-decoration-none">
                                    <img src="../asset/img/mood/like.png" alt="baik" width="55px"
                                        class="bg-black img-thumbnail rounded-circle p-2">
                                    <br>
                                    <span class="text-white small">Baik</span> </a>
                            </div>
                            <div class="emoji col-md-2 text-center">
                                <a href="survey.php?lagu=<?php echo $putar['id'] ?>&nilai=3"
                                    class="text-decoration-none">
                                    <img src="../asset/img/mood/very like.png" alt="sangat baik" width="55px"
                                        class="bg-black img-thumbnail rounded-circle p-2">
                                    <br>
                                    <span class="text-white small">Sangat Baik</span> </a>
                            </div>
                        </div>
                    </form>
                    <?php endif ?>
                </div>
                <div class="col-md-5 mt-5">
                    <div class="row">
                        <?php foreach ($hasillagu as $key => $value) : ?>
                        <?php if ($value['id_lagu'] !== $putar['id']) : ?>
                        <div class="rowA col-md-6 mb-3 border-bottom">
                            <a href="playall.php?id=<?php echo $value["id_lagu"] ?>" class=" text-decoration-none">
                                <h6 class="textA"><?php echo $value["title"] ?></h6>
                                <span class="text-white"><?php echo $value["artis"] ?></span>
                            </a>
                        </div>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>