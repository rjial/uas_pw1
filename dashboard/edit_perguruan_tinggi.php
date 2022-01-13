<?php
require("../db/config.php");
session_start();

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    header("Location: " . base_urll("login.php"));
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
        header("Location: " . base_urll("logout.php"));
        // echo "asdasdasd";
    }
    $id_pt = $_GET['id'];
    if ($id_pt > 0 || $id_pt != null) {
        $query_pt = $db->query("SELECT * FROM `perguruan_tinggi` WHERE `ID_PERGURUAN_TINGGI` = " . $id_pt);
        $array_pt = $query_pt->fetchAll()[0];
        // var_dump($array_pt);
        // die();
    } else {
        header("Location: " . base_urll("dashboard/perguruan_tinggi.php"));
    }
    if (!empty($_POST) && isset($_POST)) {
        $nama_univ = $_POST['nama-perguruan-tinggi'];
        $alamat = $_POST['alamat'];
        $akred = $_POST['akreditas'];
        $query = $db->prepare("UPDATE `perguruan_tinggi` SET `NAMA_PERGURUAN`=?,`ALAMAT`=?,`AKREDITAS`=? WHERE `ID_PERGURUAN_TINGGI` = " . $id_pt);
        $query->bindParam(1, $nama_univ);
        $query->bindParam(2, $alamat);
        $query->bindParam(3, $akred);
        $exec = $query->execute();
        if ($exec) {
            header("Location: " . base_urll("dashboard/perguruan_tinggi.php"));
        }
    }
}

// $query_perguruan_tinggi = "select * from perguruan_tinggi";
// $stmt_perguruan_tinggi = $db->query($query_perguruan_tinggi);
// $array_perguruan_tinggi = $stmt_perguruan_tinggi->fetchAll();
// var_dump($array_lomba);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguruan Tinggi - Lomba</title>
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
                        <a class="nav-link" aria-current="page" href="<?php echo base_urll("dashboard/") ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>lomba.php">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>peserta.php">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_urll("dashboard/") ?>perguruan_tinggi.php">Perguruan Tinggi</a>
                    </li>
                    <?php if ($array_level['ID_LEVEL'] == 1) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>users.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>user_level.php">User Level</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $username; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_urll("dashboard/") ?>">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- <span class="bg-dark text-white">

                </span> -->
            </div>
        </div>
    </nav>
    <div class="container mt-5 vstack gap-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h5 class="py-1">Tambah Perguruan Tinggi</h5>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nama-perguruan-tinggi" class="form-label">Nama Perguruan Tinggi</label>
                        <input type="text" name="nama-perguruan-tinggi" id="nama-perguruan-tinggi" class="form-control" value="<?php echo $array_pt["NAMA_PERGURUAN"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="6" class="form-control"><?php echo $array_pt["ALAMAT"] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="akreditas" class="form-label">Akreditas</label>
                        <select name="akreditas" id="akreditas" class="form-select">
                            <?php foreach ($akreditass as $akre) : ?>
                                <option <?php echo ($akre == $array_pt[2]) ? "selected" : "" ?> value="<?php echo $akre; ?>"><?php echo $akre; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Edit</button>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="../script/bootstrap.bundle.min.js"></script>

</html>