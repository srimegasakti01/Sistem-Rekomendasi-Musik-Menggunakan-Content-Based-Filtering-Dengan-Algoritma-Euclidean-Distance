<?php
if (!isset($_SESSION)) {
    session_start();
    include "../koneksi.php";
}

$semuaartis = array();
$ambil = $koneksi->query("SELECT * FROM penyanyi");
while ($tiap = $ambil->fetch_assoc()) {
    $semuaartis[] = $tiap;
}

?>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Import
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Import artis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="">Data artis</label>
                        <textarea class="form-control" name="artis" rows="8"></textarea>
                        <p class="small text-primary">Paste dari excel</p>
                    </div>
                    <button class="btn btn-primary btn-sm" name="import">Import</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php if (isset($_POST['import'])) {
    //Dapatkan Baris data lagu
    $lineartis = explode("\n", $_POST["artis"]);

    foreach ($lineartis as $key => $perartis) {
        $tabartis = explode("\t", $perartis);

        echo "<pre>";
        print_r($tabartis);
        echo "</pre>";



        $artis       = !isset($tabartis['0']) ? "" : $koneksi->real_escape_string($tabartis['0']);
        $jml_lagu    = !isset($tabartis['1']) ? "" : $koneksi->real_escape_string($tabartis['1']);


        //cek dulu sudah ada datanya atau belom
        $ambil = $koneksi->query("SELECT * FROM penyanyi WHERE artis='$artis' ");
        $cek = $ambil->fetch_assoc();
        if (empty($cek) and !empty($artis)) {
            $koneksi->query("INSERT INTO penyanyi(id_penyanyi, artis , jml_lagu) VALUES ('$id_penyanyi', '$artis', '$jml_lagu') ") or die(mysqli_error($koneksi));
        }
    }

    echo "<script>alert('data artis tersimpan')</script>";
    echo "<script>location = 'index.php?page=artis'</script>";
}
?>

<div class="container">
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Artis</th>
                <th>Jumlah Lagu</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($semuaartis as $key => $value) : ?>
            <tr>
                <td><?php echo $value['id_penyanyi'] ?></td>
                <td><?php echo $value['artis'] ?></td>
                <td><?php echo $value['jml_lagu'] ?></td>
                <td>
                    <img src="../asset/img/<?php echo $value["foto_artis"]; ?>" width="100" class="rounded">
                </td>
                <td class="text-center">
                    <a href="update.php?id=<?php echo $value["id_penyanyi"]; ?>"
                        class="btn btn-outline-warning">Update</a>
                    <a href="<?php echo $value["id_penyanyi"]; ?>" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>