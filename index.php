<?php
require("db/config.php");
session_start();

if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
    // header("Location: login.php");
    echo "asdasdasd";
} else {
    $id = $_SESSION['login'];
    $query = "SELECT * from user where id=" . $id;
    $stmt = $db->query($query);
    if ($stmt->rowCount() > 0) {
        $nama = $stmt->fetchColumn(3);
    } else {
        // header("Location: logout.php");
        echo "asdasdasd";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Hidden brand</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

    </div>

</body>
<script src="script/bootstrap.bundle.min.js"></script>

</html>