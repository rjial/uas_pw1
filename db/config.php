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

$jenis_lomba = [
    "Robotik",
    "Web"
];

$tingkat = [
    "Nasional",
    "Provinsi"
];

$sertifikat = [
    "LSP"
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
