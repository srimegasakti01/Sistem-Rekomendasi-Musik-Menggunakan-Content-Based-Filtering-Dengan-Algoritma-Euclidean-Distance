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
                <h5 class="modal-title" id="staticBackdropLabel">Import Lagu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="">Data Lagu</label>
                        <textarea class="form-control" name="lagu" rows="8"></textarea>
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
    $linelagu = explode("\n", $_POST["lagu"]);

    foreach ($linelagu as $key => $perlagu) {
        $tablagu = explode("\t", $perlagu);

        // echo "<pre>";
        // print_r($tablagu);
        // echo "</pre>";


        $title      = !isset($tablagu['0']) ? "" : $koneksi->real_escape_string($tablagu['0']);
        $artis      = !isset($tablagu['1']) ? "" : $koneksi->real_escape_string($tablagu['1']);
        $tahun      = !isset($tablagu['2']) ? "" : $koneksi->real_escape_string($tablagu['2']);
        $album      = !isset($tablagu['3']) ? "" : $koneksi->real_escape_string($tablagu['3']);
        $albumart   = !isset($tablagu['4']) ? "" : $koneksi->real_escape_string($tablagu['4']);
        $genre      = !isset($tablagu['5']) ? "" : $koneksi->real_escape_string($tablagu['5']);
        $valensi    = !isset($tablagu['6']) ? "" : $koneksi->real_escape_string($tablagu['6']);
        $energi     = !isset($tablagu['7']) ? "" : $koneksi->real_escape_string($tablagu['7']);

        $valensi = str_replace(",", ".", $valensi);
        $energi = str_replace(",", ".", $energi);

        //cek dulu sudah ada datanya atau belom
        $ambil = $koneksi->query("SELECT * FROM lagu WHERE title='$title' AND artis='$artis' ");
        $cek = $ambil->fetch_assoc();
        if (empty($cek) and !empty($title)) {
            $koneksi->query("INSERT INTO lagu(id_lagu, title, artis, tahun, album, albumart, genre, valensi, energi) VALUES ('$id_lagu', '$title', '$artis', '$tahun', '$album', '$albumart', '$genre', '$valensi', '$energi') ") or die(mysqli_error($koneksi));
        }
    }

    echo "<script>alert('data lagu tersimpan')</script>";
    echo "<script>location = 'index.php?page=lagu'</script>";
}
?>

<?php
include "home.php";
?>