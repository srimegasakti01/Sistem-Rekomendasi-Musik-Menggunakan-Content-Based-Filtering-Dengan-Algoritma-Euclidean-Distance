<?php
if (!isset($_SESSION)) {
    session_start();
    include "../koneksi.php";
}

$semuamood = array();
$ambil = $koneksi->query("SELECT * FROM mood");
while ($tiap = $ambil->fetch_assoc()) {
    $semuamood[] = $tiap;
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
                <h5 class="modal-title" id="staticBackdropLabel">Import mood</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="">Data mood</label>
                        <textarea class="form-control" name="mood" rows="4"></textarea>
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
    $linemood = explode("\n", $_POST["mood"]);

    foreach ($linemood as $key => $permoodan) {
        $tabmood = explode("\t", $permoodan);

        echo "<pre>";
        print_r($tabmood);
        echo "</pre>";

        $nama_mood    = !isset($tabmood['0']) ? "" : $koneksi->real_escape_string($tabmood['0']);
        $valensi      = !isset($tabmood['1']) ? "" : $koneksi->real_escape_string($tabmood['1']);
        $energi       = !isset($tabmood['2']) ? "" : $koneksi->real_escape_string($tabmood['2']);

        $valensi = str_replace(",", ".", $valensi);
        $energi = str_replace(",", ".", $energi);

        //cek dulu sudah ada datanya atau belom
        $ambil = $koneksi->query("SELECT * FROM mood WHERE nama_mood='$nama_mood' ");
        $cek = $ambil->fetch_assoc();
        if (empty($cek) and !empty($nama_mood)) {
            $koneksi->query("INSERT INTO mood(nama_mood, valensi, energi) VALUES ('$nama_mood', '$valensi', '$energi') ") or die(mysqli_error($koneksi));
        }
    }

    echo "<script>alert('data mood tersimpan')</script>";
    echo "<script>location = 'index.php?page=mood'</script>";
}
?>

<div class="container">
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori Mood</th>
                <th>Valensi</th>
                <th>Energi</th>
                <th>Option</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($semuamood as $key => $value) : ?>
            <tr>
                <td><?php echo $value['id_mood'] ?></td>
                <td><?php echo $value['nama_mood'] ?></td>
                <td><?php echo $value['valensi'] ?></td>
                <td><?php echo $value['energi'] ?></td>
                <td class="text-center">
                    <a href="<?php echo $value["id_mood"]; ?>" class="btn btn-outline-warning">Update</a>
                    <a href="<?php echo $value["id_mood"]; ?>" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>