<?php
if (!isset($_SESSION)) {
    session_start();
    include "../koneksi.php";
}

$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}
?>



<div class="container">
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Lagu</th>
                <th>Nama Artis</th>
                <th>Genre</th>
                <th>Valensi</th>
                <th>Energi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($semualagu as $key => $lagu) : ?>
            <tr>
                <td><?php echo $lagu['id_lagu'] ?></td>
                <td><?php echo $lagu['title'] ?></td>
                <td><?php echo $lagu['artis'] ?></td>
                <td><?php echo $lagu['genre'] ?></td>
                <td><?php echo $lagu['valensi'] ?></td>
                <td><?php echo $lagu['energi'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>