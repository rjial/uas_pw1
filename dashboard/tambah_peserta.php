<?php
require("../db/config.php");
session_start();

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    header("Location: /login.php");
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
}

$query_peserta = "select * from peserta";
$stmt_peserta = $db->query($query_peserta);
$array_peserta = $stmt_peserta->fetchAll();
// var_dump($array_lomba);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
                        <a class="nav-link active" href="<?php echo base_urll("dashboard/") ?>peserta.php">Peserta</a>
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
            <div class="card-body">
                <h5>Peserta</h5>
            </div>
        </div>
        <div class="card">

        </div>
    </div>

</body>
<script src="../script/bootstrap.bundle.min.js"></script>

</html>