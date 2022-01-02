<?php
require("db/config.php");
session_start();
$belum_login = true;

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    // header("Location: login.php");
    $belum_login = true;
    // echo "asdasdasd";
} else {
    $belum_login = false;
    $id = $_SESSION['login'];
    // var_dump($id);
    $query = "SELECT * from user where id_user='" . $id . "'";
    $stmt = $db->query($query);
    // var_dump($stmt);
    // die();
    // var_dump($stmt);
    if ($stmt->rowCount() > 0) {
        $nama = $stmt->fetchColumn(2);
        $query_level = $db->query("select user_level.* from user inner join user_level on user_level.id_level = user.id_level where id_user=" . $id);
        $array_level = $query_level->fetchAll()[0];
    } else {
        echo "asdasdasd";
        die();
        header("Location: /logout.php");
        // echo "asdasdasd";
    }
}
$query_lomba = "select * from lomba";
$stmt_lomba = $db->query($query_lomba);
$array_lomba = $stmt_lomba->fetchAll();
// var_dump($array_level['ID_LEVEL']);
// die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="/">Lomba</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <?php if (!$belum_login) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>">Dashboard</a>
                        </li>
                        <?php if ($array_level['ID_LEVEL'] == 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_urll("dashboard/") ?>users.php">User</a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if ($belum_login) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                                <!-- <li>
                                <hr class="dropdown-divider">
                            </li> -->
                                <!-- <li><a class="dropdown-item" href="logout.php">Logout</a></li> -->
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?php echo base_urll("index.php") ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $nama; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo base_urll("dashboard/") ?>">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo base_urll("logout.php") ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 vstack gap-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Selamat Datang di Lomba!</h1>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Daftar Lomba</h5>
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
                        </tr>
                    </th>

                    <tbody>
                        <?php foreach ($array_lomba as $lomba) : ?>
                            <tr>
                                <td><?php echo $lomba["ID_LOMBA"] ?></td>
                                <td><?php echo $lomba["NAMA_LOMBA"] ?></td>
                                <td><?php echo $lomba["JENIS_LOMBA"] ?></td>
                                <td><?php echo $lomba["TINGKAT_LOMBA"] ?></td>
                                <td><?php echo $lomba["HADIAH"] ?></td>
                                <td><?php echo $lomba["SERTIFIKAT"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<script src="script/bootstrap.bundle.min.js"></script>

</html>