<?php
try {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "uas_pw1";
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $dbname . "", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}

$base_url = "http://localhost/uas_pw1/";
function base_urll($url)
{
    global $base_url;
    return $base_url . $url;
}
function pernah_lomba($id_user, $id_lomba)
{
    global $db;
    $array_psrt = ($db->query("select * from peserta where ID_USER='" . $id_user . "'"))->fetchAll()[0];
    $query_lomba = $db->query("select * from ambil_lomba where ID_PESERTA='" . $array_psrt["ID_PESERTA"] . "' and ID_LOMBA='" . $id_lomba . "'");
    if ($query_lomba->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

$jenis_lomba = [
    "Robotik",
    "Web",
    "Desain Grafis",
    "Photo Grafis"
];

$tingkat = [
    "Nasional",
    "Provinsi", 
    "Internasional"
];

$sertifikat = [
    "LSP",
    "Cabang",
    "Kota",
    "Nasional"
];

$akreditass = [
    "A",
    "B",
    "C"
];

$kelass = [
    "XII",
    "XI",
    "X"
];

$jurusans = [
    "Bengkel",
    "Multimedia",
    "RPL"
];

$jeniskels = [
    "L" => "Laki-Laki",
    "P" => "Perempuan"
];
