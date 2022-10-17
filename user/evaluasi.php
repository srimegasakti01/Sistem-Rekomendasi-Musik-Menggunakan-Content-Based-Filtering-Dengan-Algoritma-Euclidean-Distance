<?php
include "../koneksi.php";

$id_user = $_SESSION['user']['id_user'];

//dapatkan data survey lagu 
$lagu = array();
$survey = array();
$jupuk = $koneksi->query("SELECT * FROM mood ORDER BY id_mood ASC ");
while ($permood = $jupuk->fetch_assoc()) {
    $nama_mood = trim($permood['nama_mood']);

    $ambil = $koneksi->query("SELECT * FROM survey 
        LEFT JOIN lagu on survey.id_lagu=lagu.id_lagu WHERE id_user='$id_user' AND mood='$nama_mood' ");
    while ($tiap = $ambil->fetch_assoc()) {
        $id_lagu = $tiap['id_lagu'];
        $nilai = $tiap['nilai'];
        $survey[$nama_mood][$id_lagu] = $nilai;
        $lagu[$nama_mood][] = $tiap;
    }
}



?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../asset/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
</head>

<div class="container-fluid">
    <div class="row">
        <?php $totalndcg = 0; ?>
        <?php $banyakndcg = 0; ?>
        <?php foreach ($survey as $nama_mood => $permood) : ?>
        <?php

            //hitung dcg tanpa diurutkan
            $dcg = array();
            $nomor = 1;
            foreach ($permood as $id_lagu => $nilai) {
                $dcg[$id_lagu] = $nilai / log($nomor + 1, 2);
                $nomor++;
            }

            //totalkan dcg
            $sumdcg = 0;
            foreach ($dcg as $id_lagu => $perdcg) {
                $sumdcg += $perdcg;
            }

            //urutkan berdasarkan nilai tertinggi
            arsort($permood);

            //hitung idcg diurutkan
            $idcg = array();
            $nomor = 1;
            foreach ($permood as $id_lagu => $nilai) {
                $idcg[$id_lagu] = $nilai / log($nomor + 1, 2);
                $nomor++;
            }

            //totalkan dcg
            $sumidcg = 0;
            foreach ($idcg as $id_lagu => $peridcg) {
                $sumidcg += $peridcg;
            }

            $ndcg = $sumdcg / $sumidcg;
            $totalndcg += $ndcg;
            $banyakndcg += 1;

            ?>

        <div class="col-md-6">
            <br>
            <h5 class="text">Penilaian Evaluasi Mood : <?php echo $nama_mood ?></h5>
            <table class="table border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Lagu</th>
                        <th>Lagu</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lagu[$nama_mood] as $key => $value) : ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $value['id_lagu'] ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td><?php echo $value['nilai'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="col-6">
            <div class="row">

                <div class="col-md-6">
                    <table class="table border ">
                        <br>
                        <br>
                        <thead>
                            <tr>
                                <th>i</th>
                                <th>ID Lagu</th>
                                <th>DCG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php foreach ($dcg as $id_lagu => $perdcg) : ?>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td><?php echo $id_lagu ?></td>
                                <td><?php echo $perdcg ?></td>
                            </tr>
                            <?php $nomor++ ?>
                            <?php endforeach ?>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5><?php echo number_format($sumdcg, 5) ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table border">
                        <thead>
                            <br>
                            <br>
                            <tr>
                                <th>i</th>
                                <th>ID Lagu</th>
                                <th>IDCG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php foreach ($idcg as $id_lagu => $peridcg) : ?>
                            <tr>
                                <td><?php echo $nomor ?></td>
                                <td><?php echo $id_lagu ?></td>
                                <td><?php echo $peridcg ?></td>
                            </tr>
                            <?php $nomor++ ?>
                            <?php endforeach ?>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <h5>Total</h5>
                                </td>
                                <td>
                                    <h5><?php echo number_format($sumidcg, 5) ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h5> Total NDCG Mood (<?php echo $nama_mood ?>) : <?php echo $ndcg ?></h5>
        <?php endforeach ?>

    </div>

    <br>

    <div class="row">
        <hr>
        <table class="col-md-12 border" style="font-size: 20px;">
            <tr>
                <th>Total Skenario :</th>
                <th>Total Nilai Skenario NDCG :</th>
                <th>Rata-rata Nilai NDCG :</th>

            </tr>
            <tr>
                <td class="text-center">
                    <?php echo $banyakndcg ?>
                </td>
                <td class="text-center">
                    <?php echo number_format($totalndcg, 5)  ?>
                </td>
                <td class="bg-warning text-center"><?php echo number_format($totalndcg / $banyakndcg, 5)  ?></td>
            </tr>
        </table>
    </div>
</div>