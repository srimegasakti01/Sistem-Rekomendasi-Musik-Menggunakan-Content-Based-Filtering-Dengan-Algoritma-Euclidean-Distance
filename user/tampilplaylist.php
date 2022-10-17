<?php
include "../koneksi.php";

//id_user yang login
$id_user = $_SESSION["user"]["id_user"];


$playlist = array();
$ambil = $koneksi->query("SELECT * FROM playlist LEFT JOIN lagu ON playlist.id_lagu=lagu.id_lagu WHERE id_user='$id_user' ");
while ($tiap = $ambil->fetch_assoc()) {
    $playlist[] = $tiap;
}




?>

<div class="row ">
    <?php foreach ($playlist as $key => $value) : ?>
    <div class="col-md-12 pt-2 ps-0 border-bottom">
        <a href="play.php?id=<?php echo $value["id_lagu"] ?>">
            <!-- <div class="bg-secondary" style="min-height:90px;"></div> -->
            <h5 class="pt-1 text-white"><?php echo $value["title"] ?></h5>
            <span class="text-white small "><?php echo $value["artis"] ?></span>
        </a>
    </div>
    <?php endforeach ?>
</div>