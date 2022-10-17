<?php
include "../koneksi.php";
$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

//siapkan hasil lagu untuk perhitungan
$hasillagu = array();
//dapatkan inputan user dari klik icon mood
$valensi_user = $_POST['valensi'];
$energi_user = $_POST['energi'];
$_SESSION['mood'] = $_POST['mood'];
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
?>

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
<section>
    <h2 class="mb-4">Rekomendasi For You</h2>
    <div class="row">
        <?php foreach ($hasillagu as $key => $perlagu) : ?>
        <div class=" recom col-md-6">
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
</section>

<?php if (!empty($hasillagu)) : ?>
<a href="playall.php" class="btn btn-outline-warning d-block w-100 mt-3">Play All</a>
<?php endif ?>