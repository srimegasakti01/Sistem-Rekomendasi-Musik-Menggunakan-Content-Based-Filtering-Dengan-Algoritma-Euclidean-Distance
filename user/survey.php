<?php
include "../koneksi.php";
$id_lagu = $_GET['lagu'];
$nilai = $_GET['nilai'];

$id_user = $_SESSION["user"]['id_user'];
$mood = $_SESSION["mood"];

$koneksi->query("INSERT INTO survey (id_lagu,id_user,nilai,mood) VALUES ('$id_lagu', '$id_user', '$nilai', '$mood') ");

echo "<script>alert('Terima Kasih telah mengisi survey lagu ini')</script>";
echo "<script>location='playall.php?id=$id_lagu'</script>";