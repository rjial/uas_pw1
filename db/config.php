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
