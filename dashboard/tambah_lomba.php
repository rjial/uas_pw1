<?php
require("../db/config.php");
session_start();

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    header("Location: login.php");
    // echo "asdasdasd";
} else {
    $id = $_SESSION['login'];
    $query = "SELECT * from user where id_user='" . $id . "'";
    $stmt = $db->query($query);
    // var_dump($stmt);
    // die();
    if ($stmt->rowCount() > 0) {
        $username = $stmt->fetchColumn(2);
        $query_level = $db->query("select user_level.* from user inner join user_level on user_level.id_level = user.id_level where id_user=" . $id);
        $array_level = $query_level->fetchAll()[0];
    } else {
        header("Location: /logout.php");
        // echo "asdasdasd";
    }
    if (!empty($_POST) && isset($_POST)) {
        // var_dump($_POST);
        $namalmb = $_POST['nama-lomba'];
        $jenislmb = $_POST['jenis-lomba'];
        $tngkt = $_POST['tingkat'];
        $hdh = $_POST['hadiah'];
        $srti = $_POST['sertifikat'];
        $ptt = $_POST['pt'];
        $query = $db->prepare("INSERT INTO `lomba`(`NAMA_LOMBA`, `JENIS_LOMBA`, `TINGKAT_LOMBA`, `HADIAH`, `SERTIFIKAT`, `ID_LOMBA`, `ID_PERGURUAN_TINGGI`) VALUES (?, ?, ?, ?, ?, NULL, ?)");
        $exec = $query->execute([$namalmb, $jenislmb, $tngkt, $hdh, $srti, $ptt]);
        if ($exec) {
            header("Location: /dashboard/lomba.php");
        }
        // foreach ($_POST as $data) {
        //     echo $data;
        // }

    }
}

$query_pt = "select * from perguruan_tinggi";
$stmt_pt = $db->query($query_pt);
$array_pt = $stmt_pt->fetchAll();
// var_dump($array_pt);
// die();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lomba</title>
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="../">Lomba</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/dashboard/lomba.php">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/peserta.php">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/perguruan_tinggi.php">Perguruan Tinggi</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $username; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 vstack gap-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h5 class="py-1">Tambah Lomba</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama-lomba" class="form-label">Nama Lomba</label>
                        <input type="text" name="nama-lomba" id="nama-lomba" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="jenis-lomba" class="form-label">Jenis Lomba</label>
                        <select name="jenis-lomba" id="jenis-lomba" class="form-select">
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach ($jenis_lomba as $jenis) : ?>
                                <option value="<?php echo $jenis; ?>"><?php echo $jenis; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tingkat" class="form-label">Tingkat</label>
                        <select name="tingkat" id="tingkat" class="form-select">
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach ($tingkat as $tngkt) : ?>
                                <option value="<?php echo $tngkt; ?>"><?php echo $tngkt; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sertifikat" class="form-label">Sertifikat</label>
                        <select name="sertifikat" id="sertifikat" class="form-select">
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach ($sertifikat as $serti) : ?>
                                <option value="<?php echo $serti; ?>"><?php echo $serti; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pt" class="form-label">Perguruan Tinggi</label>
                        <select name="pt" id="pt" class="form-select">
                            <option value="">Pilih Salah Satu</option>
                            <?php foreach ($array_pt as $perti) : ?>
                                <option value="<?php echo $perti['ID_PERGURUAN_TINGGI']; ?>"><?php echo $perti["NAMA_PERGURUAN"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hadiah" class="form-label">Hadiah</label>
                        <input type="number" name="hadiah" id="hadiah" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Tambah</button>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="../script/bootstrap.bundle.min.js"></script>

</html>