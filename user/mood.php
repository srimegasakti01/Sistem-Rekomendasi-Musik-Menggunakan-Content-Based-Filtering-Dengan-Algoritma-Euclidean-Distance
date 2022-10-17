<?php
include "../koneksi.php";

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda harus login')</script>";
    echo "<script>location = '../login.php' </script>";
}

$semualagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu");
while ($tiap = $ambil->fetch_assoc()) {
    $semualagu[] = $tiap;
}

$semuamood = array();
$ambil = $koneksi->query("SELECT * FROM mood");
while ($nyokot = $ambil->fetch_assoc()) {
    $semuamood[] = $nyokot;
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
    <?php include "menu.php"; ?>

    <form method="post">
        <input type="hidden" name="mood">
        <input type="hidden" name="valensi">
        <input type="hidden" name="energi">


        <div class=" container">
            <div class="row mt-5 pb-3">
                <div class="col-8">
                    <h2 class="text-white">Pilih Suasana Hati Kamu Saat ini</h2>
                    <hr>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-primary" name="submit">Submit</button>
                </div>
            </div>
            <div class="row" style="font-size: 20px; ">
                <div class="col-md-2"> </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <div class="card bg-black mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="happy" valensi="0.90"
                                energi="0.15">
                            <label class="form-check-label" for="happy">
                                <img src="../asset/img/mood/happy.png"
                                    class="bg-black img-thumbnail rounded-circle p-2">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">
                                    Happy</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Delighted" valensi="0.90"
                                energi="0.35" checked>
                            <label class="form-check-label" for="Delighted">
                                <img src="../asset/img/mood/delighted.png"
                                    class="bg-black img-thumbnail rounded-circle p-2" width="110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Delighted</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Excited" valensi="0.70"
                                energi="0.72" checked>
                            <label class="form-check-label" for="Excited">
                                <img src="../asset/img/mood/excited.png"
                                    class="bg-black img-thumbnail rounded-circle p-2" width="110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Excited</h5>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Sleepy" valensi="0.02"
                                energi="-1" checked>
                            <label class="form-check-label" for="Sleepy">
                                <img src="../asset/img/mood/sleepy.png"
                                    class="bg-black img-thumbnail rounded-circle p-2">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Sleepy</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Calm" valensi="0.70"
                                energi="-0.65" checked>
                            <label class="form-check-label" for="Calm">
                                <img src="../asset/img/mood/calm.png" class="bg-black img-thumbnail rounded-circle p-2">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Calm</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Content" valensi="0.80"
                                energi="-0.55" checked>
                            <label class="form-check-label" for="Content">
                                <img src="../asset/img/mood/content.png"
                                    class="bg-black img-thumbnail rounded-circle p-2">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Content</h5>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Tense" valensi="-0.02"
                                energi="0.85" checked>
                            <label class="form-check-label" for="Tense">
                                <img src="../asset/img/mood/tense.png" class="bg-black img-thumbnail rounded-circle p-2"
                                    width="110px" style="height:110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Tense</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Angry" valensi="-0.4"
                                energi="0.8" checked>
                            <label class="form-check-label" for="Angry">
                                <img src="../asset/img/mood/angry.png" class="bg-black img-thumbnail rounded-circle p-2"
                                    width="110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Angry</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Distressed" valensi="-0.70"
                                energi="0.55" checked>
                            <label class="form-check-label" for="Distressed">
                                <img src="../asset/img/mood/distressed.png"
                                    class="bg-black img-thumbnail rounded-circle p-2" width="130px"
                                    style="height:110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Distressed</h5>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Sad" valensi="-0.80"
                                energi="-0.4" checked>
                            <label class="form-check-label" for="Sad">
                                <img src="../asset/img/mood/sad.png" class="bg-black img-thumbnail rounded-circle p-2"
                                    width="110px" style="height:110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Sad</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Despressed" valensi="-0.82"
                                energi="-0.45" checked>
                            <label class="form-check-label" for="Despressed">
                                <img src="../asset/img/mood/despressed.png"
                                    class="bg-black img-thumbnail rounded-circle p-2" style="height:110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Despressed</h5>
                            </label>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="card bg-black  mb-2" style="width:120px;">
                            <input class="form-check-input" type="radio" name="mood" id="Bored" valensi="-0.35"
                                energi="-0.80" checked>
                            <label class="form-check-label" for="Bored">
                                <img src="../asset/img/mood/bored.png" class="bg-black img-thumbnail rounded-circle p-2"
                                    style="height:110px">
                                <h5 class="text-center text-white mt-2" style="font-size:20px;">Bored</h5>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        if (!empty($_POST['valensi']) and !empty($_POST['energi'])) {
            $valensi = $_POST['valensi'];
            $energi = $_POST['energi'];
            $_SESSION['mood'] = $_POST['mood'];
            echo "<script>location='index.php?valensi=$valensi&energi=$energi'</script>";
        } else {
            echo "amikom";
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    //apabila ada mood di klik, maka dapatkan nilai valensi dan energinya, 
    //lalu suruh carilagu.php untuk mendapatkan hasil sesuai valensi dan energi.
    $(document).ready(function() {
        $(".form-check-input").on("click", function() {
            var valensi = $(this).attr("valensi");
            var energi = $(this).attr("energi");
            var mood = $(this).attr("id");

            $("input[name=mood]").val(mood);
            $("input[name=energi]").val(energi);
            $("input[name=valensi]").val(valensi);

            $.ajax({
                type: 'post',
                url: 'carilagu.php',
                data: 'valensi=' + valensi + '&energi=' + energi,
                beforeSend: function() {
                    $('#wait').show();
                },
                complete: function() {
                    $('#wait').hide();
                },
                success: function(hasil) {
                    $(".letak-hasil").html(hasil);
                }
            })
        })
    })
    </script>



</body>

</html>