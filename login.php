<?php
require("db/config.php");
session_start();
function cek_ada($field)
{
    if (isset($field) && !empty($field)) {
        return true;
    }
}
$warning = array();
if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
    header("Location: index.php");
}
if (cek_ada($_POST) || cek_ada($_POST)) {
    if (cek_ada($_POST['username_login']) && cek_ada($_POST['password_login'])) {
        $username = $_POST['username_login'];
        $password = $_POST['password_login'];
        $password = md5($password);
        // var_dump(["username" => $username, "password" => $password]);
        // die();
        $query = "SELECT * from user where username='" . $username . "' and password='" . $password . "'";
        $stmt = $db->query($query);
        if ($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn(0)[0];
            $_SESSION['login'] = $id;
            header("Location: index.php");
        } else {
            array_push($warning, "Username dan password salah");
        }
    } else {
        array_push($warning, "Username dan Password kosong");
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

<body class="vh-100 vw-100 d-flex justify-content-center align-items-center">

    <div class="login w-25">
        <div class="card ">
            <div class="card-body">
                <h5 class="text-center">Login</h5>
                <div class="form-login">

                </div>
            </div>
        </div>
    </div>
</body>
<script src="script/bootstrap.bundle.min.js"></script>

</html>