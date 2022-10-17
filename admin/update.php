<?php
include "../koneksi.php";
// untuk mendapatkan id dari url menggunakan variabel $_GET

$id_penyanyi = $_GET['id'];

// ambil data dari database berdasarkan id yang diambil
$SemuaArtis = array();
$ambil = $koneksi->query("SELECT * FROM penyanyi WHERE id_penyanyi='$id_penyanyi' ");
while ($tiap = $ambil->fetch_assoc()) {
    $SemuaArtis[] = $tiap;
}
echo "<pre>";
print_r($SemuaArtis);
echo "</pre>";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rungo Admin 2</title>
    <!-- Custom fonts for this template-->
    <link href="../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../asset/css/sb-admin-2.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Ubah Data Admin</h2>
        <hr>
        <div class="row">
            <div class="col-7">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="artis_nama"
                            value="<?php echo $SemuaArtis["artis"]; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <img src="../asset/img/<?php echo $SemuaArtis["foto_artis"]; ?>" width="100"
                            class="rounded mb-1">
                        <input type="file" class="form-control" name="admin_foto">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-outline-primary" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    if (isset($_POST['simpan'])) {
        $artis = $_POST['artis_nama'];

        $foto_artis = $_FILES['admin_foto']['name'];
        $file = $_FILES['admin_foto']['tmp_name'];

        // Kondisi tanpa merubah file
        if (empty($file)) {
            $koneksi->query("UPDATE penyanyi SET
			artis_nama = '$artis' WHERE id_penyanyi = '$id_penyanyi' ");
        } else {
            $koneksi->query("UPDATE penyanyi SET
			artis_nama = '$artis',
			foto_admin = '$foto_artis' WHERE id_penyanyi = '$id_penyanyi' ");

            move_uploaded_file($file, "../asset/img/$foto");
        }

        echo "<script>alert('Data sudah diubah')</script>";
        echo "<script>location = 'index.php?page=artis' </script>";
    }



    ?>

</body>

</html>