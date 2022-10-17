<?php
include "../koneksi.php";

$id_lagu = $_POST['id_lagu'];

if (isset($id_lagu) && !empty($id_lagu)) {
    //dapatkan user yang login
    $id_user = $_SESSION['user']['id_user'];

    //cek dulu user ini sudah memasukkan lagu ini ke playlist belom
    $ambil = $koneksi->query("SELECT * FROM playlist WHERE id_user='$id_user' AND id_lagu='$id_lagu' ");
    $cekplaylist = $ambil->fetch_assoc();

    if (empty($cekplaylist)) {
        $koneksi->query("INSERT INTO playlist(id_user,id_lagu)VALUES('$id_user','$id_lagu')");
    }
}