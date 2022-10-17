<?php

include "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="asset/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="asset/css/style3.css" />
</head>

<body class="log-in">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 offset-md-0 shadow ">
                <form class="box p-3 rounded mt-3 shadow" method="post">
                    <h4 class="text-center">LOGIN</h4>
                    <div class=" mb-3">
                        <label for="floatingInput" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="name@example.com" name="email">
                    </div>
                    <div class=" mb-3">
                        <label for="floatingInput" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="*******" name="password">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" name="login">Login</button>
                        <a href="#" class="forgot ms-5">Forgot?</a>
                    </div>
                    <div class="text-center py-3">
                        <h5 href="" class="text-decoration-none small">Have no account?
                            <a href="register.php">Register</a>
                        </h5>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cek = $koneksi->query("SELECT * FROM admin WHERE email_admin = '$email' AND password_admin = '$password' ");
        $hitung = $cek->num_rows;

        if ($hitung == 1) {
            $data_login = $cek->fetch_assoc();
            $_SESSION["admin"] = $data_login;
            echo "<script>alert('Login Berhasil')</script>";
            echo "<script>location = 'admin/' </script>";
        } else {
            $cek1 = $koneksi->query("SELECT * FROM user WHERE email_user = '$email' AND password_user = '$password' ");
            $hitung1 = $cek1->num_rows;
            if ($hitung1 == 1) {
                $data_login1 = $cek1->fetch_assoc();
                $_SESSION["user"] = $data_login1;
                echo "<script>alert('Login Berhasil')</script>";
                echo "<script>location = 'user/modal.php' </script>";
            } else {
                echo "<script>alert('Email or Password Salah')</script>";
                echo "<script>location = 'login.php' </script>";
            }
        }
    }

    // echo "<pre>";
    // print_r($hitung1);
    // echo "</pre>";

    ?>



</body>

</html>