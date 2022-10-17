<?php
include "../koneksi.php";
//mendapatkan lagu yang link youtube nya kosong
$lagu = array();
$ambil = $koneksi->query("SELECT * FROM lagu WHERE link_youtube='' ");
while ($tiap = $ambil->fetch_assoc()) {
    $lagu[] = $tiap;
}

foreach ($lagu as $key => $perlagu) {
    $id_lagu = $perlagu['id_lagu'];
    $keyword = $perlagu['artis'] . " " . $perlagu["title"];
    $keyword = urlencode($keyword);
    $googleApiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . $keyword . "&maxResults=1&key=AIzaSyCf1hdvhGE3Vz8Fzihvsd43vhhoUjNokZ0";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    if ($response) {
        $data = json_decode($response, TRUE);
        if (isset($data['items'])) {
            $link_youtube = $data['items'][0]['id']['videoId'];
            $koneksi->query("UPDATE lagu SET link_youtube='$link_youtube' WHERE id_lagu='$id_lagu' ");
        } else {
            exit();
        }
    }
}