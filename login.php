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
        $query = "SELECT * from admin where username='" . $username . "' and password='" . $password . "'";
        $stmt = $db->query($query);
        if ($stmt->rowCount() > 0) {
            $id = $stmt->fetchColumn(0);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body class="vh-100 vw-100 d-flex justify-content-center align-items-center">

    <div class="login w-25">
        <div class="card ">
            <div class="card-body">
                <h5 class="text-center">Login</h5>
                <div class="form-login mt-3">
                    <form action="" method="post" class="vstack gap-2">
                        <div class="vstack gap-2">
                            <label for="username">Username</label>
                            <input type="text" name="username_login" id="username_login" class="form-control">
                        </div>
                        <div class="vstack gap-2">
                            <label for="password">Password</label>
                            <input type="text" name="password_login" id="password_login" class="form-control">
                        </div>
                        <div>
                            <button class="btn btn-primary float-end" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="script/bootstrap.bundle.min.js"></script>

</html>