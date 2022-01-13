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
        // var_dump($array_level);
        // die();
    } else {
        header("Location: " . base_urll("logout.php"));
        // echo "asdasdasd";
    }
}

$query_lomba = "select * from lomba inner join perguruan_tinggi on lomba.id_perguruan_tinggi = perguruan_tinggi.id_perguruan_tinggi";
$stmt_lomba = $db->query($query_lomba);
$array_lomba = $stmt_lomba->fetchAll();

// untuk soal 8

// $array_lomba = $stmt_lomba->fetch();
// echo "<pre>";
// while ($lomba = $stmt_lomba->fetch()) {
//     var_dump($lomba);
//     echo "-----------------------------------------------";
// }
// $lomba = $stmt_lomba->fetch();
// var_dump($lomba);

// echo "</pre>";
// die();

// $array_lomba = $stmt_lomba->fetchAll();
// echo "<pre>";
// var_dump($array_lomba);
// echo "</pre>";
// die();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba - Lomba</title>
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
                        <a class="nav-link active" href="<?php echo base_urll("dashboard/") ?>lomba.php">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>peserta.php">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>perguruan_tinggi.php">Perguruan Tinggi</a>
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
            </div>
        </div>
    </nav>
    <div class="container mt-5 vstack gap-4">
        <div class="card">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h5 class="float-start my-2">Lomba</h5>
                <?php if ($array_level['ID_LEVEL'] == 1) : ?>
                    <a href="<?php echo base_urll("dashboard/tambah_lomba.php") ?>" class="btn btn-success flex-end">Tambah</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Jenis</td>
                            <td>Tingkat</td>
                            <td>Hadiah</td>
                            <td>Sertifikat</td>
                            <td>Universitas</td>
                            <td>Action</td>
                        </tr>
                    </th>

                    <tbody>
                        <?php $ids = 1 ?>
                        <?php if (count($array_lomba) > 0) : ?>
                            <?php foreach ($array_lomba as $lomba) : ?>
                                <tr>
                                    <td><?php echo $ids ?></td>
                                    <td><?php echo $lomba["NAMA_LOMBA"] ?></td>
                                    <td><?php echo $lomba["JENIS_LOMBA"] ?></td>
                                    <td><?php echo $lomba["TINGKAT_LOMBA"] ?></td>
                                    <td><?php echo $lomba["HADIAH"] ?></td>
                                    <td><?php echo $lomba["SERTIFIKAT"] ?></td>
                                    <td><?php echo $lomba["NAMA_PERGURUAN"] ?></td>
                                    <?php if ($array_level["ID_LEVEL"] == 1) : ?>
                                        <td><a href="edit_lomba.php?id=<?php echo $lomba["ID_LOMBA"] ?>" class="btn btn-primary me-3">Edit</a><a href="hapus_lomba.php?id=<?php echo $lomba["ID_LOMBA"] ?>" class="btn btn-danger me-3">Hapus</a></td>
                                    <?php elseif ($array_level["ID_LEVEL"] == 2) : ?>
                                        <?php if (pernah_lomba($id, $lomba["ID_LOMBA"])) : ?>
                                            <td><a href="tdkikut_lomba.php?id=<?php echo $lomba["ID_LOMBA"] ?>" class="btn btn-danger">Tidak Ikuti</a></td>
                                        <?php else : ?>
                                            <td><a href="ikuti_lomba.php?id=<?php echo $lomba["ID_LOMBA"] ?>" class="btn btn-primary">Ikuti</a></td>
                                        <?php endif ?>
                                    <?php endif ?>
                                </tr>
                                <?php $ids++ ?>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<script src="../script/bootstrap.bundle.min.js"></script>

</html>