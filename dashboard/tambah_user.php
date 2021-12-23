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
    if (!empty($_POST) && isset($_POST)) {
        var_dump($_POST);
        $user_name = $_POST['username'];
        $pass_word = $_POST['password'];
        $levell = $_POST['level'];
        $query = $db->prepare("INSERT INTO `user`(`ID_USER`, `ID_LEVEL`, `USERNAME`, `PASSWORD`) VALUES (NULL, ?,?,?)");
        $exec = $query->execute([$levell, $user_name, md5($pass_word)]);
        $last_user = $db->lastInsertId();
        if ($exec) {
            if ($levell == 2) {
                $nama_peserta = $_POST['nama_peserta'];
                $kelas = $_POST['kelas'];
                $asal = $_POST['asal'];
                $jenis_kelamin = $_POST['jeniskelamin'];
                $jurusan = $_POST['jurusan'];
                $alamat = $_POST['alamat'];
                $query_peserta = $db->prepare("INSERT INTO `peserta`(`NAMA`, `KELAS`, `ASAL`, `JENIS_KELAMIN`, `JURUSAN`, `ALAMAR`, `ID_PESERTA`, `ID_USER`) VALUES (?,?,?,?,?,?,NULL,?)");
                $exec_peserta = $query_peserta->execute([$nama_peserta, $kelas, $asal, $jenis_kelamin, $jurusan, $alamat, $last_user]);
                if ($exec_peserta) {
                    header("Location: /dashboard/users.php");
                }
            } else {
                header("Location: /dashboard/users.php");
            }
        }
    }
}

$query_users = "select user.*, user_level.nama_level from user inner join user_level on user.id_level = user_level.id_level";
$stmt_users = $db->query($query_users);
$array_users = $stmt_users->fetchAll();
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
                        <a class="nav-link" aria-current="page" href="/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/lomba.php">Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/peserta.php">Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/perguruan_tinggi.php">Perguruan Tinggi</a>
                    </li>
                    <?php if ($array_level['ID_LEVEL'] == 1) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard/users.php">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard/user_level.php">User Level</a>
                        </li>
                    <?php endif; ?>
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
    <div class="container my-5 vstack gap-4">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select onchange="get_select()" name="level" id="level" class="form-control">
                            <option value="">Pilih Salah Satu</option>
                            <option value="1">Admin</option>
                            <option value="2">Peserta</option>
                        </select>
                    </div>
                    <div class="peserta d-none" id="peserta">
                        <div class="mb-3">
                            <label for="nama_peserta">Nama</label>
                            <input type="text" name="nama_peserta" id="nama_peserta" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="kelas">Kelas</label>
                            <!-- <input type="text" name="kelas" id="kelas" class="form-control"> -->
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <?php foreach ($kelass as $kelas) : ?>
                                    <option value="<?php echo $kelas ?>"><?php echo $kelas ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="asal">Asal</label>
                            <input type="text" name="asal" id="asal" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jeniskelamin" id="jeniskelamin" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <?php foreach ($jeniskels as $jk => $jeniskel) : ?>
                                    <option value="<?php echo $jk ?>"><?php echo $jeniskel ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option value="">Pilih Salah Satu</option>
                                <?php foreach ($jurusans as $jurusan) : ?>
                                    <option value="<?php echo $jurusan ?>"><?php echo $jurusan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="../script/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener("load", function() {
        var form_peserta = document.getElementById("peserta")
        // var form_peserta2 = document.getElementById("peserta")
        // console.log(form_peserta)
        // document.getElementById("peserta").remove()
    })


    function get_select() {
        var select_level = document.getElementById("level");
        console.log(select_level.value)
        var peserta = document.getElementById("peserta")
        if (select_level.value == 2) {
            peserta.classList.remove("d-none")
            peserta.classList.add("d-block")
        } else {
            peserta.classList.add("d-none")
            peserta.classList.remove("d-block")
        }
    }
</script>

</html>