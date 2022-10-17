<?php

include "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="asset/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="asset/css/style3.css" />
</head>

<body class="log-in">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 offset-md-0 shadow ">
                <form class="box p-3 rounded mt-3 shadow" method="post">

                    <h4 class="text-center mb-3 mt-3">SIGN IN</h4>
                    <div class=" mb-3">
                        <label for="floatingInput" class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="name@example.com" name="nama">
                    </div>
                    <div class=" mb-3">
                        <label for="floatingInput" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="email@example.com" name="email">
                    </div>
                    <div class=" mb-3">
                        <label for="floatingInput" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="*******" name="password">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" name="simpan">Register</button>
                    </div>
                    <div class="text-center">
                        <h5 href="" class="text-decoration-none small">Have account?
                            <a href="login.php">LOGIN</a>
                        </h5>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["simpan"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        $koneksi->query("INSERT INTO user (nama_user,email_user, password_user) VALUES('$nama','$email','$password')");
        echo "<script>alert('Registrasi Berhasil')</script>";
        echo "<script>location = 'login.php'</script>";
    }

    // echo "<pre>";
    // print_r($hitung1);
    // echo "</pre>";

    ?>



</body>

</html>