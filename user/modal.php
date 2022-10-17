<?php
include "../koneksi.php";

$SemuaArtis = array();
$ambil = $koneksi->query("SELECT * FROM penyanyi");
while ($tiap = $ambil->fetch_assoc()) {
    $SemuaArtis[] = $tiap;
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
    <link rel="stylesheet" href="../asset/vendor/jquery/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
</head>

<body class="bg-black">

    <?php
    include "menu.php";
    ?>

    <div class=" container">

        <form method="POST">
            <div class="row mt-5 pb-3">
                <div class="col-8">
                    <h2 class="text-white ">Pilih Artis Favoritmu</h2>
                </div>
                <div class="col-4">
                    <button class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
            <div class="row">
                <?php foreach ($SemuaArtis as $key => $value) :  ?>
                <div class="col-md-2 ">
                    <div class="card bg-black mb-4 border-bottom">
                        <input class="form-check-input" type="checkbox" id="<?php echo $value["id_penyanyi"] ?>"
                            name="id_penyanyi[]" value="<?php echo $value["id_penyanyi"] ?>">
                        <label for="<?php echo $value["id_penyanyi"] ?>">
                            <img src="../asset/img/artis/<?php echo $value["foto_artis"]; ?>"
                                class="img-thumbnail rounded-circle p-2">
                        </label>
                        <div class="card-body text-white">
                            <h5 class="text-center text-white"><?php echo $value["artis"] ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </form>
    </div>
</body>

</html>
<?php
if (isset($_POST['id_penyanyi'])) {
    $id_penyanyis = $_POST['id_penyanyi'];
    $id_user = $_SESSION['user']['id_user'];
    foreach ($id_penyanyis as $key => $id_penyanyi) {
        $ambil = $koneksi->query("SELECT * FROM favorit WHERE id_user='$id_user' AND id_penyanyi='$id_penyanyi'");
        $cekfavorit = $ambil->fetch_assoc();

        if (empty($cekfavorit)) {
            $koneksi->query("INSERT INTO favorit (id_user, id_penyanyi) VALUES ('$id_user', '$id_penyanyi')");
        }
    }
    echo "<script>alert('Tersimpan di Favorit')</script>";
    echo "<script>location = 'mood.php' </script>";
}
?>